<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEspace;
use App\PaymentMode;
use Illuminate\Http\Request;

class PaymentModeController extends AdminBaseController
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
        $this->categories = PaymentMode::all();
        return view('admin.payment-mode.create', $this->data);
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
            'espace_name' => 'required|unique:payment_modes'
        ]);
        $category = new PaymentMode();
        $category->espace_name = $request->espace_name;
        $category->save();
        $categoryData = PaymentMode::all();
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
            'espace_name' => 'required|unique:payment_modes'
        ]);
        $category = PaymentMode::find($id);
        $category->espace_name = $request->espace_name;
        $category->save();
        $categoryData = PaymentMode::all();
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
        PaymentMode::destroy($id);
        $categoryData = PaymentMode::all();
        return Reply::successWithData(__('messages.espaceDeleted'), ['data' => $categoryData]);
    }
}
