<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectTemplate\StoreProjectPlace;
use App\ProjectPlace;
use Illuminate\Http\Request;

class ManageProjectTechnologyController extends AdminBaseController
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
        $this->categories = ProjectPlace::all();
        return view('admin.project-category.create', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCat()
    {
        $this->categories = ProjectPlace::all();
        return view('admin.projects.create-technology', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectPlace $request)
    {
        $category = new ProjectPlace();
        $category->place_name = $request->place_name;
        $category->save();

        return Reply::success(__('messages.placeAdded'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCat(StoreProjectPlace $request)
    {
        $category = new ProjectPlace();
        $category->place_name = $request->place_name;
        $category->save();
        $categoryData = ProjectPlace::all();
        return Reply::successWithData(__('messages.placeAdded'), ['data' => $categoryData]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProjectPlace::destroy($id);
        $categoryData = ProjectPlace::all();
        return Reply::successWithData(__('messages.placeDeleted'), ['data' => $categoryData]);
    }
}
