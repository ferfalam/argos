<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\SubTaskTitle;
use Illuminate\Http\Request;

class ManageSubTaskTitleController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->titles = SubTaskTitle::all();
        return view('admin.sub-task-title.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = new SubTaskTitle();
        $category->name = $request->name;
        $category->save();
        $categoryData = SubTaskTitle::all();
        return Reply::successWithData(__('messages.milestoneTitleAdded'), ['data' => $categoryData]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            'name' => 'required'
        ]);
        $category = SubTaskTitle::find($id);
        $category->name = $request->name;
        $category->save();
        $categoryData = SubTaskTitle::all();
        return Reply::successWithData(__('messages.milestoneTitleUpdated'), ['data' => $categoryData]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubTaskTitle::destroy($id);
        $categoryData = SubTaskTitle::all();
        return Reply::successWithData(__('messages.milestoneTitleDeleted'), ['data' => $categoryData]);
    }
}
