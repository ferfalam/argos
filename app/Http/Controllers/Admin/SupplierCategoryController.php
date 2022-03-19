<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SupplierCategory;
use App\SupplierSubCategory;
use App\Helper\Reply;
use App\Http\Requests\Admin\Client\StoreClientCategory;

class SupplierCategoryController extends AdminBaseController
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
        $this->categories = SupplierCategory::all();
        return view('admin.suppliers.create_category', $this->data);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientCategory $request)
    {
        $category = new SupplierCategory();
        $category->category_name = $request->category_name;
        $category->save();
        $categoryData = SupplierCategory::all();
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
        $category = SupplierCategory::find($id);
        $category->category_name = $request->category_name;
        $category->save();
        $categoryData = SupplierCategory::all();
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
        SupplierCategory::destroy($id);
        $categories = SupplierCategory::all();
        return Reply::successWithData(__('messages.categoryDeleted'), ['data' => $categories]);
    }

}
