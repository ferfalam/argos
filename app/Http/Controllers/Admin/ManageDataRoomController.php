<?php

namespace App\Http\Controllers\Admin;

use App\DataRoom;
use App\Espace;
use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\Task;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

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

    public function createCat($task_id, $file_id)
    {
        $this->task_room = Task::find($task_id);
        $this->espaces = Espace::all();
        $this->file_id = $file_id;
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
        $dataRoom->user_id = user()->id;
        $dataRoom->last_update_user_id = user()->id;
        //dd($dataRoom);
        $dataRoom->save();
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
        $this->employees = User::allEmployeesByCompany(company()->id);
        $this->admins = User::allAdminsByCompany(company()->id);
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
        DataRoom::destroy($id);
        return Reply::success(__('messages.dataRoomDeleted'));
    }
}
