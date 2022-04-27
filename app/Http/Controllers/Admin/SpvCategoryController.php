<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\StoreClientCategory;
use App\SpvCategory;
use Illuminate\Http\Request;

class SpvCategoryController extends AdminBaseController
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
        $this->categories = SpvCategory::all();
        return view('admin.spv.create_category', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientCategory $request)
    {
        $category = new SpvCategory();
        $category->category_name = $request->category_name;
        $category->save();
        $categoryData = SpvCategory::all();
        return Reply::successWithData(__('messages.categoryAdded'), ['data' => $categoryData]);
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
        $category = SpvCategory::find($id);
        $category->category_name = $request->category_name;
        $category->save();
        $categoryData = SpvCategory::all();
        return Reply::successWithData(__('messages.categoryUpdated'), ['data' => $categoryData]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SpvCategory::destroy($id);
        $categories = SpvCategory::all();
        return Reply::successWithData(__('messages.categoryDeleted'), ['data' => $categories]);
    }
}
