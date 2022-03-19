<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\StoreClientSubcategory;
use App\SpvCategory;
use App\SpvSubCategory;
use Illuminate\Http\Request;

class SpvSubCategoryController extends AdminBaseController
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
        $this->subcategories = SpvSubCategory::all();
        $this->categories = SpvCategory::all();
        return view('admin.spv.create-subcategory', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientSubcategory $request)
    {
        $category = new SpvSubCategory();
        $category->category_id = $request->category_id;
        $category->category_name = $request->category_name;
        $category->save();
        $categoryData = SpvSubCategory::with('spv_category')->get();
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
        $category = SpvSubCategory::find($id);
        $category->category_id = $request->category_id;
        $category->category_name = $request->category_name;
        $category->save();
        $categoryData = SpvSubCategory::with('supplier_category')->get();
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
        SpvSubCategory::destroy($id);
        $categoryData = SpvSubCategory::all();
        return Reply::successWithData(__('messages.categoryDeleted'), ['data' => $categoryData]);
    }
}
