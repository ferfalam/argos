<?php

namespace Modules\Zoom\Http\Controllers;


use App\ClientDetails;
use App\Helper\Reply;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Project;
use App\User;
use App\UserChat;
use App\Notification;
use App\EmployeeFaq;
use Illuminate\Http\Request;
use Modules\Zoom\DataTables\Admin\OfflineMeetingDataTable;
use Modules\Zoom\Entities\Category;
use Modules\Zoom\Entities\ClientHasMeeting;
use Modules\Zoom\Entities\Meeting;
use Modules\Zoom\Entities\MeetingHasUser;
use Modules\Zoom\Entities\Room;
use Modules\Zoom\Entities\ZoomMeeting;
use Modules\Zoom\Entities\ZoomSetting;
use Modules\Zoom\Events\MeetingInviteEvent;
use Modules\Zoom\Notifications\OffMeetingInvite;
use Modules\Zoom\Http\Requests\Meeting\StoreMeeting;
use App\ProjectTimeLog;

class MeetingController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('zoom::app.menu.meeting');
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OfflineMeetingDataTable $dataTable)
    {
		$user = \Auth::user();
        $this->username = $user->name;
		$roles = $user->roles()->get();
		$this->role = $roles[0]->name;
		//if($roles[0]->name =='employee'){
			$this->user=$user;
			$this->timer = ProjectTimeLog::memberActiveTimer($this->user->id);
			$this->employeeTheme = employee_theme();
            $this->superadmin = global_settings();
            $this->faqs = EmployeeFaq::all();
			$this->userRole = $roles[0];
			$this->unreadNotificationCount = count($this->user->unreadNotifications);
            $this->unreadMessageCount = UserChat::where('to', $this->user->id)->where('message_seen', 'no')->count();
            $this->unreadExpenseCount = Notification::where('notifiable_id', $this->user->id)
                ->where(function ($query) {
                    $query->where('type', 'App\Notifications\NewExpenseStatus');
                    $query->orWhere('type', 'App\Notifications\NewExpenseMember');
                })
                ->whereNull('read_at')
                ->count();
            $this->unreadProjectCount = Notification::where('notifiable_id', $this->user->id)
                ->where('type', 'App\Notifications\NewProjectMember')
                ->whereNull('read_at')
                ->count();
		//}
        $this->employees = User::allEmployees();
        $this->clients = User::allClients();
        $this->categories = Category::all();
        $this->projects = Project::all();
        $this->rooms = Room::all();

        return $dataTable->render('zoom::meeting.index', $this->data);
    }
    public function calendar()
    {
		$user = \Auth::user();
        $this->username = $user->name;
		$roles = $user->roles()->get();
		$this->role = $roles[0]->name;
		if($roles[0]->name =='employee'){
			$this->user=$user;
			$this->timer = ProjectTimeLog::memberActiveTimer($this->user->id);
			$this->employeeTheme = employee_theme();
            $this->superadmin = global_settings();
            $this->faqs = EmployeeFaq::all();
			$this->userRole = $roles[0];
			$this->unreadNotificationCount = count($this->user->unreadNotifications);
            $this->unreadMessageCount = UserChat::where('to', $this->user->id)->where('message_seen', 'no')->count();
            $this->unreadExpenseCount = Notification::where('notifiable_id', $this->user->id)
                ->where(function ($query) {
                    $query->where('type', 'App\Notifications\NewExpenseStatus');
                    $query->orWhere('type', 'App\Notifications\NewExpenseMember');
                })
                ->whereNull('read_at')
                ->count();
            $this->unreadProjectCount = Notification::where('notifiable_id', $this->user->id)
                ->where('type', 'App\Notifications\NewProjectMember')
                ->whereNull('read_at')
                ->count();
		}
        $this->employees = User::allEmployees();
        $this->clients = User::allClients();
        $this->categories = Category::all();
        $this->projects = Project::all();
        $this->rooms = Room::all();
        $this->events = Meeting::all();

        return view('zoom::meeting.calendar', $this->data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeeting $request)
    {
		$user = \Auth::user();
        $this->username = $user->name;
		$roles = $user->roles()->get();
		$this->role = $roles[0]->name;
		if($roles[0]->name =='employee'){
			$this->user=$user;
			$this->timer = ProjectTimeLog::memberActiveTimer($this->user->id);
			$this->employeeTheme = employee_theme();
            $this->superadmin = global_settings();
            $this->faqs = EmployeeFaq::all();
			$this->userRole = $roles[0];
			$this->unreadNotificationCount = count($this->user->unreadNotifications);
            $this->unreadMessageCount = UserChat::where('to', $this->user->id)->where('message_seen', 'no')->count();
            $this->unreadExpenseCount = Notification::where('notifiable_id', $this->user->id)
                ->where(function ($query) {
                    $query->where('type', 'App\Notifications\NewExpenseStatus');
                    $query->orWhere('type', 'App\Notifications\NewExpenseMember');
                })
                ->whereNull('read_at')
                ->count();
            $this->unreadProjectCount = Notification::where('notifiable_id', $this->user->id)
                ->where('type', 'App\Notifications\NewProjectMember')
                ->whereNull('read_at')
                ->count();
		}
        $s = "$request->start_date $request->start_time";
        $sdate = strtotime($s);
        $sdate = date('Y-m-d H:i:s', $sdate);
        $e = "$request->end_date $request->end_time";
        $edate = strtotime($e);
        $edate = date('Y-m-d H:i:s', $edate);
        $meeting = new Meeting();
        $meeting->title = $request->meeting_title;
        $meeting->description = $request->description;
        $meeting->start_date_time = $sdate;
        $meeting->end_date_time = $edate;
        $meeting->label = $request->label_color;
        $meeting->status = 'waiting';
        $meeting->room_idroom = $request->room;
        $meeting->save();
        $attendees = [];
        $clients = [];
        if ($request->all_employees) {
            $attendees = User::allEmployees();
        } else {
            if($request->employee_id){
                $attendees = User::whereIn('id', $request->employee_id)->get();
            }
        }
        if ($request->all_clients) {
            $clients = User::allClients();
        } elseif ($request->has('client_id')) {
            $clients = User::where('id', $request->client_id)->get();
        }
        foreach ($attendees as $attendee){
            $meetinghasuser =new MeetingHasUser();
            $meetinghasuser->meeting_idmeeting = $meeting->idmeeting;
            $meetinghasuser->users_id = $attendee->id;
            $meetinghasuser->save();
        }
        foreach ($clients as $client){
            $meetinghasclient = new ClientHasMeeting();
            $meetinghasclient->client_details_id = $client->client[0]->id;
            $meetinghasclient->meeting_idmeeting = $meeting->idmeeting;
            $meetinghasclient->save();
        }
        return Reply::success(__('messages.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $offmeeting)
    {
        $event = $offmeeting;
        return view('zoom::meeting.show', ['event' => $event, 'global' => $this->global]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $offmeeting)
    {
		$user = \Auth::user();
        $this->username = $user->name;
		$roles = $user->roles()->get();
		$this->role = $roles[0]->name;
		if($roles[0]->name =='employee'){
			$this->user=$user;
			$this->timer = ProjectTimeLog::memberActiveTimer($this->user->id);
			$this->employeeTheme = employee_theme();
            $this->superadmin = global_settings();
            $this->faqs = EmployeeFaq::all();
			$this->userRole = $roles[0];
			$this->unreadNotificationCount = count($this->user->unreadNotifications);
            $this->unreadMessageCount = UserChat::where('to', $this->user->id)->where('message_seen', 'no')->count();
            $this->unreadExpenseCount = Notification::where('notifiable_id', $this->user->id)
                ->where(function ($query) {
                    $query->where('type', 'App\Notifications\NewExpenseStatus');
                    $query->orWhere('type', 'App\Notifications\NewExpenseMember');
                })
                ->whereNull('read_at')
                ->count();
            $this->unreadProjectCount = Notification::where('notifiable_id', $this->user->id)
                ->where('type', 'App\Notifications\NewProjectMember')
                ->whereNull('read_at')
                ->count();
		}
        $this->event = $offmeeting;
        $this->employees = User::allEmployees();
        $this->clients = User::allClients();
        $this->categories = Category::all();
        $this->projects = Project::all();
        $this->rooms = Room::all();

        return view('zoom::meeting.edit', $this->data);
    }
    public function OfflineInvite(Meeting $meeting){
        $attendees = $meeting->users;
//        event(new MeetingInviteEvent($meeting, $attendees));
        foreach ($attendees as $attendee){
            \Illuminate\Support\Facades\Notification::send($attendee, new OffMeetingInvite($meeting));
        }
        return redirect()->back();
    }

    public function roomajax(){
        $rooms = Room::where('company_id', company()->id)->get();
        return view('zoom::room.ajax',compact('rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $offmeeting)
    {
        $s = "$request->start_date $request->start_time";
        $sdate = strtotime($s);
        $sdate = date('Y-m-d H:i:s', $sdate);
        $e = "$request->end_date $request->end_time";
        $edate = strtotime($e);
        $edate = date('Y-m-d H:i:s', $edate);
        $offmeeting->title = $request->meeting_title;
        $offmeeting->description = $request->description;
        $offmeeting->start_date_time = $sdate;
        $offmeeting->end_date_time = $edate;
        $offmeeting->label = $request->label_color;
        $offmeeting->status = 'waiting';
        $offmeeting->room_idroom = $request->room;
        $offmeeting->save();
        $attendees = [];
        $clients = [];
        if ($request->all_employees) {
            $attendees = User::allEmployees();
        } else {
            if($request->employee_id){
                $attendees = User::whereIn('id', $request->employee_id)->get();
            }
        }
        if ($request->all_clients) {
            $clients = User::allClients();
        } elseif ($request->has('client_id')) {
            $clients = User::where('id', $request->client_id)->get();
        }
        foreach ($offmeeting->user_has_meetings as $uhs){
            $uhs->delete();
        }
        foreach ($attendees as $attendee){
            $meetinghasuser =new MeetingHasUser();
            $meetinghasuser->meeting_idmeeting = $offmeeting->idmeeting;
            $meetinghasuser->users_id = $attendee->id;
            $meetinghasuser->save();
        }
        foreach ($offmeeting->client_has_meetings as $chm){
            $chm->delete();
        }
        foreach ($clients as $client){
            $meetinghasclient = new ClientHasMeeting();
            $meetinghasclient->client_details_id = $client->client[0]->id;
            $meetinghasclient->meeting_idmeeting = $offmeeting->idmeeting;
            $meetinghasclient->save();
        }
        return Reply::success(__('messages.createSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $offmeeting)
    {
        foreach ($offmeeting->user_has_meetings as $uhs){
            $uhs->delete();
        }
        foreach ($offmeeting->client_has_meetings as $chm){
            $chm->delete();
        }
        $offmeeting->delete();
        return Reply::success(__('messages.deleteSuccess'));
    }
    public function cancelMeeting()
    {
        $id = request('id');
        Meeting::where('idmeeting', $id)->update([
            'status' => 'canceled'
        ]);

        return Reply::success(__('messages.updateSuccess'));
    }
}
