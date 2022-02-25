<?php

namespace Modules\Zoom\Http\Controllers;

use App\Helper\Reply;
use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Zoom\Entities\Category;
use Modules\Zoom\Http\Requests\Category\StoreCategory;

class CategoryController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('zoom::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $this->categories = Category::all();
        return view('zoom::category.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreCategory $request)
    {
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        $categoryData = Category::all();
        return Reply::successWithData(__('messages.categoryAdded'),['data' => $categoryData]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('zoom::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('zoom::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        $categoryData = Category::all();
        return Reply::successWithData(__('messages.categoryDeleted'),['data' => $categoryData]);
    }
}
