<?php

namespace Modules\Zoom\Http\Controllers;



use App\Helper\Reply;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Modules\Zoom\DataTables\Admin\RoomDataTable;
use Modules\Zoom\Entities\Category;
use Modules\Zoom\Entities\Room;
use Modules\Zoom\Entities\ZoomMeeting;
use Modules\Zoom\Entities\ZoomSetting;
use Modules\Zoom\Http\Requests\Meeting\StoreRoom;
use Modules\Zoom\Http\Requests\Meeting\UpdateRoom;

class RoomController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('zoom::app.menu.room');
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
    public function index(RoomDataTable $dataTable)
    {
        $this->employees = User::allEmployees();
        $this->clients = User::allClients();
        $this->events = ZoomMeeting::all();
        $this->categories = Category::all();
        $this->projects = Project::all();
        return $dataTable->render('zoom::room.index', $this->data);
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
    public function store(StoreRoom $request)
    {
        $room = new Room();
        $room->name = $request->room_title;
        $room->capacity= $request->room_capacity;
        $room->location = $request->room_location;
        $room->save();
        return Reply::success(__('messages.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('zoom::room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoom $request, Room $room)
    {
        $room->name = $request->room_title;
        $room->capacity= $request->room_capacity;
        $room->location = $request->room_location;
        $room->save();
        return Reply::success(__('messages.createSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return Reply::success(__('messages.deleteSuccess'));
    }
}
