<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEspace;
use App\SellType;
use Illuminate\Http\Request;

class SellTypeContoller  extends AdminBaseController
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
        $this->categories = SellType::all();
        return view('admin.sell-type.create', $this->data);
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
            'espace_name' => 'required|unique:sell_types'
        ]);
        $category = new SellType();
        $category->espace_name = $request->espace_name;
        $category->save();
        $categoryData = SellType::all();
        return Reply::successWithData(__('messages.espaceAdded'), ['data' => $categoryData]);
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
            'espace_name' => 'required|unique:sell_types'
        ]);
        $category = SellType::find($id);
        $category->espace_name = $request->espace_name;
        $category->save();
        $categoryData = SellType::all();
        return Reply::successWithData(__('messages.espaceUpdated'), ['data' => $categoryData]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SellType::destroy($id);
        $categoryData = SellType::all();
        return Reply::successWithData(__('messages.espaceDeleted'), ['data' => $categoryData]);
    }
}
