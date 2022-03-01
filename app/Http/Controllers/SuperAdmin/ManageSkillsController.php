<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helper\Reply;
use App\Skill;
use Google\Service\PeopleService\Skill as PeopleServiceSkill;
use Illuminate\Http\Request;

class ManageSkillsController extends SuperAdminBaseController
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
        $this->skills = Skill::all();
        $this->type = "skill_id";
        return view('super-admin.super-admin.skill_option', $this->data);
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
            'name' => 'required|string',
        ]);

        $skill = Skill::where('name', $request->name)->get();
        if (count($skill) > 0) {
            return Reply::error($request->type . " existe déjà");
        }

        $skill = new Skill();
        $skill->company_id = company()->id;
        $skill->name = $request->name;
        $skill->save();

        return Reply::successWithData(__('Success'), ['status' => 'success', 'skill' => $skill]);
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
        $request->validate([
            'name' => 'required|string',
        ]);

        $skill = Skill::where("id", $id)->first();
        $skill->name = $request->name;
        $skill->update();

        return Reply::successWithData(__('Success'), ['status' => 'success', 'skill' => $skill]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = Skill::where("id", $id)->get();
        Skill::where("id", $id)->delete();
        return Reply::successWithData(__('Success'), ['status' => 'success', 'skill' => $skill[0]]);
    }
}
