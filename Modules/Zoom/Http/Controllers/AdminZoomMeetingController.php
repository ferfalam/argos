<?php

namespace Modules\Zoom\Http\Controllers;

use App\Helper\Files;
use App\Helper\Reply;
use App\Http\Controllers\Admin\AdminBaseController;
use App\MeetingFile;
use App\User;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MacsiDigital\Zoom\Facades\Zoom;
use Modules\Zoom\Entities\ZoomMeeting;
use Modules\Zoom\Events\MeetingInviteEvent;
use Modules\Zoom\Http\Requests\ZoomMeeting\StoreMeeting;
use Modules\Zoom\DataTables\Admin\MeetingDataTable;
use Modules\Zoom\Entities\ZoomSetting;
use Modules\Zoom\Entities\Category;
use Modules\Zoom\Http\Requests\ZoomMeeting\UpdateMeeting;
use Modules\Zoom\Http\Requests\ZoomMeeting\UpdateOccurrence;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Modules\Zoom\Events\MeetingCancelEvent;

class AdminZoomMeetingController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('zoom::app.menu.zoomMeeting');
        $this->pageIcon = 'fa fa-video-camera';
        logger(user());

        $this->middleware(function ($request, $next) {
            ZoomSetting::setZoom();
            if (!in_array('Zoom', $this->user->modules)) {
                abort(403);
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $this->users = User::allUsersByCompany(user()->company_id);
        $this->employees = User::allEmployeesByCompany(user()->company_id);
        $this->clients = User::allExternesByCompany(user()->company_id);
        $this->admins = User::allAdminsByCompany(user()->company_id);
        $this->events = ZoomMeeting::all();
        $this->categories = Category::all();
        $this->projects = Project::all();
        return view('zoom::meeting-calendar.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('zoom-meeting::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreMeeting $request)
    {
        $meeting = $this->createOrUpdateMeetings($request);

        return Reply::successWithData(__('messages.createSuccess'), ["meetingID" => $meeting->id]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $this->event = ZoomMeeting::with('attendees', 'host')->findOrFail($id);
        $this->zoomSetting = ZoomSetting::where('user_id', user()->id)->first();
        $this->meetingFiles = MeetingFile::where('meeting_id', $id)->get();
        $date = Carbon::parse($this->event->start_date_time);
        $now = Carbon::now();
        $this->diff = $date->diffInMinutes($now);
        return view('zoom::meeting-calendar.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $this->event = ZoomMeeting::with('attendees')->findOrFail($id);
        $this->users = User::allUsersByCompany(user()->company_id);
        $this->employees = User::allEmployeesByCompany(user()->company_id);
        $this->clients = User::allExternesByCompany(user()->company_id);
        $this->admins = User::allAdminsByCompany(user()->company_id);
        $this->categories = Category::all();
        $this->projects = Project::all();

        $this->upload = can_upload();
        if (!is_null($this->event->occurrence_id)) {
            return view('zoom::meeting-calendar.edit_occurrence', $this->data);
        }

        $this->meetingFiles = MeetingFile::where('meeting_id', $id)->get();

        return view('zoom::meeting-calendar.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateMeeting $request, $id)
    {
        $this->createOrUpdateMeetings($request, $id);

        return Reply::dataOnly(['meetingID' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $meeting = ZoomMeeting::findOrFail($id);

        if ($meeting->status == 'waiting' && $meeting->end_date_time->gte(Carbon::now())) {
            return Reply::error('Veuillez terminer ou annuler avant de supprimer cette réunion');
        }

        // destroy meeting via zoom api
        if (!is_null($meeting->occurrence_id)) {
            $zoomMeeting =  Zoom::meeting()->find($meeting->meeting_id);

            if (request()->has('recurring') && request('recurring') == "yes") {
                //delete all occurrences
                $occurrence = $zoomMeeting->occurrences()->delete();
            } else {
                //delete single occurrence
                $occurrence = $zoomMeeting->occurrences()->find($meeting->occurrence_id);
                $occurrence->delete();
            }
        } else {
            $zoomMeeting = Zoom::user()->find('me')->meetings()->find($meeting->meeting_id);
            if ($zoomMeeting) {
                $zoomMeeting->delete();
            }
        }

        $meeting->attendees()->detach();
        $meeting->delete();

        return Reply::success(__('messages.deleteSuccess'));
    }

    public function createMeeting($user, ZoomMeeting $meeting, $id, $meetingId = null, $host = null)
    {
        // create meeting using zoom API
        $commonSettings = [
            'type' => 2,
            'topic' => $meeting->meeting_name,
            'start_time' => $meeting->start_date_time,
            'duration' => $meeting->end_date_time->diffInMinutes($meeting->start_date_time),
            'timezone' => $this->global->timezone,
            'agenda' => $meeting->description,
            'alternative_host' => [],
            'settings' => [
                'host_video' => $meeting->host_video == 1,
                'participant_video' => $meeting->participant_video == 1,
            ]
        ];

        if ($host) {
            $commonSettings['alternative_host'] = [$host->email];
        }

        if (is_null($id)) {
            $zoomMeeting = $user->meetings()->make($commonSettings);
            $savedMeeting = $user->meetings()->save($zoomMeeting);

            $meeting->meeting_id = strval($savedMeeting->id);
            $meeting->start_link = $savedMeeting->start_url;
            $meeting->join_link = $savedMeeting->join_url;
            $meeting->password = $savedMeeting->password;

            $meeting->save();
        } else {
            $user->meetings()->find($meeting->meeting_id)->update($commonSettings);
        }

        return $meeting;
    }

    public function createOrUpdateMeetings($request, $id = null)
    {
        $host = User::find($request->create_by);
        $user = Zoom::user()->find('me');

        if ($request->has('repeat') && $request->repeat) {
            $this->createRepeatMeeting($user, $request, $id);
        } else {
            $meeting = is_null($id) ? new ZoomMeeting() : ZoomMeeting::find($id);
            $data = $request->all();
            $data['meeting_name'] = $request->meeting_title;
            $data['start_date_time'] = $request->start_date . 'T' . $request->start_time;
            $data['end_date_time'] = $request->end_date . 'T' . $request->end_time;

            $start = Carbon::parse($request->start_date . ' ' . $request->start_time);
            $end = Carbon::parse($request->end_date . ' ' . $request->end_time);

            $diff = $start->diffInMinutes($end);

            $hours = ($diff / 60) <= 9 ? '0' . intval($diff / 60) : intval($diff / 60);
            $minutes = $diff % 60 <= 9 ? '0' . $diff % 60 : $diff % 60;
            $data['duree'] = $hours . ' : ' . $minutes;

            if (is_null($id)) {
                $meeting = $meeting->create($data);
                $this->syncAttendees($request, $meeting, 'no');
                $this->createMeeting($user, $meeting, $id, null, $host);
                return $meeting;
            } else {
                $meeting->update($data);
                $this->syncAttendees($request, $meeting);
                $this->createMeeting($user, $meeting, $id, null, $host);
            }
        }
    }

    public function syncAttendees($request, $meeting, $sendInvitation = null)
    {
        $attendees = [];
        if ($request->all_employees) {
            $attendees = User::allEmployees();
        } else {
            if ($request->employee_id) {
                $attendees = User::whereIn('id', $request->employee_id)->get();
            }
        }
        if ($request->all_clients) {
            $attendees = User::allClients()->merge($attendees);
        } elseif ($request->has('client_id')) {
            $attendees = User::whereIn('id', $request->client_id)->get()->merge($attendees);
        }
        if ($attendees) {
            $meeting->attendees()->sync($attendees);
        }

        if ($sendInvitation === 'yes') {
            event(new MeetingInviteEvent($meeting, $attendees));
        }
    }

    public function OnlineInvite(ZoomMeeting $meeting)
    {
        //dd($meeting);
        $attendees = $meeting->attendees;
        event(new MeetingInviteEvent($meeting, $attendees));
        $meeting->invite = true;
        $meeting->save();
        return redirect()->back();
    }

    public function tableView(MeetingDataTable $dataTable)
    {
        $this->employees = User::allEmployeesByCompany(user()->company_id);
        $this->clients = User::allExternesByCompany(user()->company_id);
        $this->admins = User::allAdminsByCompany(user()->company_id);
        $this->categories = Category::all();
        $this->projects = Project::all();
        $this->upload = can_upload();

        //dd($this->user);

        return $dataTable->render('zoom::meeting-calendar.table', $this->data);
    }

    /**
     * start zoom meeting in app
     *
     * @return \Illuminate\Http\Response
     */
    public function startMeeting($id)
    {
        $this->zoomSetting = ZoomSetting::where('user_id', user()->id)->first();
        $this->meeting = ZoomMeeting::findOrFail($id);
        $start = Carbon::now();
        $end = $this->meeting->end_date_time;

        $date_time = explode(" ", $start->format('d-m-Y H:i'));

        $this->meeting->start_date_time = $date_time[0] . 'T' . $date_time[1];
        $this->meeting->status = 'live';
        $this->meeting->save();
        $this->zoomMeeting = Zoom::meeting()->find($this->meeting->meeting_id);
        return view('zoom::meeting-calendar.start_meeting', $this->data);
    }

    /**
     * cancel meeting
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelMeeting()
    {
        $id = request('id');
        $meeting = ZoomMeeting::where('id', $id);

        $attendees = $meeting->get()[0]->attendees;

        event(new MeetingInviteEvent($meeting->get()[0], $attendees, true));

        $meeting->update([
            'status' => 'canceled'
        ]);

        return Reply::success(__('messages.updateSuccess'));
    }

    /**
     * end meeting
     *
     * @return \Illuminate\Http\Response
     */
    public function endMeeting()
    {
        $id = request('id');
        $meeting = ZoomMeeting::findOrFail($id);

        $zoomMeeting = Zoom::meeting()->find($meeting->meeting_id);
        if ($zoomMeeting) {
            $zoomMeeting->endMeeting();
        }

        $start = $meeting->start_date_time;
        $end = Carbon::now();

        $diff = $start->diffInMinutes($end);

        $hours = intval($diff / 60) <= 9 ? '0' . intval($diff / 60) : intval($diff / 60);
        $minutes = $diff % 60 <= 9 ? '0' . $diff % 60 : $diff % 60;

        $date_time = explode(" ", $end->format('d-m-Y H:i'));
        $meeting->end_date_time = $date_time[0] . 'T' . $date_time[1];
        $meeting->duree = $hours . ' : ' . $minutes;
        $meeting->status = 'finished';
        $meeting->save();

        return Reply::success(__('messages.updateSuccess'));
    }

    public function leaveMeeting($id)
    {
        $meeting = ZoomMeeting::findOrFail($id);

        $zoomMeeting = Zoom::meeting()->find($meeting->meeting_id);
        if ($zoomMeeting) {
            $zoomMeeting->endMeeting();
        }

        $start = $meeting->start_date_time;
        $end = Carbon::now();

        $diff = $start->diffInMinutes($end);

        $hours = intval($diff / 60) <= 9 ? '0' . intval($diff / 60) : intval($diff / 60);
        $minutes = $diff % 60 <= 9 ? '0' . $diff % 60 : $diff % 60;

        $date_time = explode(" ", $end->format('d-m-Y H:i'));
        $meeting->end_date_time = $date_time[0] . 'T' . $date_time[1];
        $meeting->duree = $hours . ' : ' . $minutes;
        $meeting->status = 'finished';
        $meeting->save();

        return Redirect::route('admin.zoom-meeting.table-view');
    }

    /**
     * create repeated meeting
     *
     * @return \Illuminate\Http\Response
     */
    public function createRepeatMeeting($user, $request, $id)
    {
        //create first record in db
        $meeting = new ZoomMeeting();
        $data = $request->all();
        $data['meeting_name'] = $request->meeting_title;
        $data['start_date_time'] = $request->start_date . 'T' . $request->start_time;
        $data['end_date_time'] = $request->end_date . 'T' . $request->end_time;
        $meeting = $meeting->create($data);
        $meeting->source_meeting_id = $meeting->id;
        $meeting->occurrence_order = 1;
        $meeting->save();
        $meetingId = $meeting->id;

        $this->syncAttendees($request, $meeting, 'yes');

        //create other records with reference to first
        $repeatCount = $request->repeat_every;
        $repeatType = $request->repeat_type;
        $repeatCycles = $request->repeat_cycles;
        $startDate = Carbon::createFromFormat($this->global->date_format, $request->start_date);
        $dueDate = Carbon::createFromFormat($this->global->date_format, $request->end_date);

        for ($i = 1; $i < $repeatCycles; $i++) {
            $startDate = $startDate->add($repeatCount, str_plural($repeatType));
            $dueDate = $dueDate->add($repeatCount, str_plural($repeatType));

            $otherMeeting = new ZoomMeeting();
            $data['start_date_time'] = $startDate->format($this->global->date_format) . 'T' . $request->start_time;
            $data['end_date_time'] = $dueDate->format($this->global->date_format) . 'T' . $request->end_time;
            $data['source_meeting_id'] = $meetingId;
            $data['occurrence_order'] = $i + 1;
            $otherMeeting = $otherMeeting->create($data);

            $this->syncAttendees($request, $otherMeeting);
        }

        //create meeting on zoom
        $startDate = Carbon::createFromFormat($this->global->date_format . ' ' . $this->global->time_format, $request->start_date . ' ' . $request->start_time);

        $zoomMeeting = Zoom::meeting()->make([
            'topic' => $request->meeting_title,
            'type' => 8,
            'start_time' => $startDate, // best to use a Carbon instance here.
            'agenda' => $request->description,
            'settings' => [
                'host_video' => $request->host_video == 1,
                'participant_video' => $request->participant_video == 1,
            ]
        ]);

        $repeatInterval = $request->repeat_every;
        $repeatCycles = $request->repeat_cycles;

        if ($request->repeat_type == "day") {
            $repeatType = 1;
        } elseif ($request->repeat_type == "week") {
            $repeatType = 2;
        } else {
            $repeatType = 3;
        }

        $repeatData = [
            'type' => $repeatType,
            'repeat_interval' => intval($repeatInterval),
            'end_times' => intval($repeatCycles)
        ];

        if ($repeatType == 2) {
            $repeatData['weekly_days'] = $startDate->dayOfWeek + 1;
        }

        $zoomMeeting->recurrence()->make($repeatData);
        $savedMeeting = $user->meetings()->save($zoomMeeting);


        //save zoom response data
        $meeting->meeting_id = $savedMeeting->id;
        $meeting->start_link = $savedMeeting->start_url;
        $meeting->join_link = $savedMeeting->join_url;
        $meeting->password = $savedMeeting->password;
        $meeting->save();

        $repeatCycles = $request->repeat_cycles;
        $meetingId = $meeting->id;

        for ($i = 1; $i < $repeatCycles; $i++) {
            ZoomMeeting::where('source_meeting_id', $meetingId)->update(
                [
                    'meeting_id' => $savedMeeting->id,
                    'start_link' => $savedMeeting->start_url,
                    'join_link' => $savedMeeting->join_url,
                    'password' => $savedMeeting->password,
                ]
            );
        }
    }

    /**
     * update meeting occurrence
     *
     * @return \Illuminate\Http\Response
     */
    public function updateOccurrence(UpdateOccurrence $request, $id)
    {
        $zoomMeeting = ZoomMeeting::find($id);
        $data = $request->all();
        $data['start_date_time'] = $request->start_date . 'T' . $request->start_time;
        $data['end_date_time'] = $request->end_date . 'T' . $request->end_time;
        $zoomMeeting->update($data);

        $meeting =  Zoom::meeting()->find($zoomMeeting->meeting_id);
        $occurrence = $meeting->occurrences()->find($zoomMeeting->occurrence_id);
        $occurrence->start_time = $zoomMeeting->start_date_time;
        $occurrence->save();
        return Reply::success(__('messages.meetingUpdateSuccess'));
    }

    public function storeFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $limitReached = false;
            foreach ($request->file as $fileData) {
                $upload = can_upload($fileData->getSize() / (1000 * 1024));
                if ($upload) {
                    $file = new MeetingFile();
                    $file->company_id = company()->id;
                    $file->user_id = user()->id;
                    $file->meeting_id = $request->meeting_id;

                    $filename = Files::uploadLocalOrS3($fileData, 'meeting-files/' . $request->meeting_id);

                    $file->filename = $fileData->getClientOriginalName();
                    $file->hashname = $filename;
                    $file->size = $fileData->getSize();
                    $file->save();
                } else {
                    $limitReached = true;
                }
            }
            if ($limitReached) {
                return Reply::error(__('messages.storageLimitExceed', ['here' => '<a href=' . route('admin.billing.packages') . '>Here</a>']));
            }
        }


        // $view = view('admin.tasks.ajax-list', $this->data)->render();

        return Reply::success(__('messages.fileUploaded'));

        //        return Reply::redirect(route('admin.all-tasks.index'), __('modules.projects.projectUpdated'));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download($id)
    {
        $file = MeetingFile::findOrFail($id);
        return download_local_s3($file, 'meeting-files/' . $file->meeting_id . '/' . $file->hashname);
    }
}
