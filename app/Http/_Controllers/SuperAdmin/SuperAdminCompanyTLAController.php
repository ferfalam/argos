<?php

namespace App\Http\Controllers\SuperAdmin;

use App\CompanyTLA;
use App\Helper\Reply;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuperAdminCompanyTLAController extends SuperAdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        dd("IL EST LA");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($type)
    {

    }

    public function create2($type)
    {
        $this->tla = CompanyTLA::where("type", $type)->get();
        $this->type = $type;
        return view('super-admin.super-admin.create_option', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string'
        ]);

        $tla = CompanyTLA::where('type', $request->type)->where('name', $request->name)->get();
        if (count($tla)>0) {
            return Reply::error($request->type." existe déjà");
        }

        $tla = new CompanyTLA();
        $tla->type = $request->type;
        $tla->name = $request->name;
        $tla->slug = str_slug($request->name);
        $tla->save();

        return Reply::successWithData(__('Success'), ['status' => 'success', 'tla' => $tla]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        $tla = CompanyTLA::where("id", $id)->get();
        CompanyTLA::where("id", $id)->delete();
        return Reply::successWithData(__('Success'), ['status' => 'success', 'tla' => $tla[0]]);
    }
}
