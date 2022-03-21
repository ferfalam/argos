<?php

namespace App\Http\Controllers\Admin;

use App\DataRoom;
use App\DataRoomHistory;
use App\Espace;
use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\Notifications\NewDocInDataRoomNotification;
use App\SubTask;
use App\SubTaskFile;
use App\Task;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ManageDataRoomController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.data-room.create");
    }

    public function createCat($type, $task_id, $file_id)
    {
        $this->task_room = $type == 'task' ?  Task::find($task_id) : SubTask::find($task_id);
        $this->project_name = $type == 'task' ?  $this->task_room->project->project_name : $this->task_room->task->project->project_name;
        $this->task_name = $type == 'task' ?  $this->task_room->heading : $this->task_room->task->heading;
        $this->espaces = Espace::all();
        $this->file_id = $file_id;
        $this->type = $type;
        return view("admin.data-room.create", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'doc_name' => "required"
            ]
            );

        $dataRoom = new DataRoom();
        $dataRoom->doc_name = $request->doc_name;
        $dataRoom->project_name = $request->project_name;
        $dataRoom->task_name = $request->task_name;
        $dataRoom->file_id = $request->file_id;
        $dataRoom->espace_id = $request->espace_id;
        $dataRoom->type = $request->type;
        $dataRoom->user_id = user()->id;
        $dataRoom->last_update_user_id = user()->id;
        $dataRoom->save();

        company()->supervisor()->notify(new NewDocInDataRoomNotification($dataRoom));
        return Reply::success(__('messages.dataRoomAdded'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->doc = DataRoom::find($id);
        $this->espaces = Espace::all();
        $this->all_users = User::where('company_id', company()->id)->where("super_admin", "0")->get();
        // $this->admins = User::allAdminsByCompany(company()->id);
        //dd($this->doc);
        return view("admin.data-room.edit", $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataRoom = DataRoom::find($id);
        $dataRoom->doc_name = $request->doc_name;
        $dataRoom->project_name = $request->project_name;
        $dataRoom->task_name = $request->task_name;
        $dataRoom->file_id = $request->file_id;
        $dataRoom->espace_id = $request->espace_id;
        $dataRoom->type = $request->type;
        $dataRoom->last_update_user_id = user()->id;
        $dataRoom->publish = $request->publish == "1" ? true : false;
        if ( $dataRoom->publish) {
            $dataRoom->publish_date = new DateTime();
        }else{
            $dataRoom->publish_date = null;
        }
        $dataRoom->visible_by = $request->visible_by == "" ? "" : json_encode($request->visible_by);
        if ($request->all) {
            $dataRoom->visible_by = "all";
        }
        //dd($dataRoom);
        $dataRoom->update();
        $history = new DataRoomHistory();
        $history->user_id = user()->id;
        $history->data_room_id = $id;
        $history->details = "updateDoc";
        $history->save();
        return Reply::success(__('messages.dataRoomUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $history = new DataRoomHistory();
        $history->user_id = user()->id;
        $history->details = "deleteDoc";
        $history->title = DataRoom::find($id)->doc_name;
        $history->save();
        DataRoom::destroy($id);
        return Reply::success(__('messages.dataRoomDeleted'));
    }

    public function history($id)
    {
        $this->doc_histories = DataRoomHistory::where('data_room_id', $id)->whereNotNull('data_room_id')->orderBy('created_at', 'DESC')->get(); 
        return view("admin.document.history", $this->data);
    }

    public function saveHistory(Request $request, $id)
    {
        $history = new DataRoomHistory();
        $history->user_id = user()->id;
        $history->data_room_id = $id;
        $history->details = $request->details;
        $history->save();
    }
}
