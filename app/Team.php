<?php

namespace App;

use App\Observers\TeamObserver;
use App\Scopes\CompanyScope;

class Team extends BaseModel
{

    protected static function boot()
    {
        parent::boot();

        static::observe(TeamObserver::class);

        static::addGlobalScope(new CompanyScope);
    }

    public function members()
    {
        return $this->hasMany(EmployeeTeam::class, 'team_id');
    }

    public function member()
    {
        $users = User::where('company_id', company()->id)->get();
        $members = array();
        foreach ($users as $key => $user) {
            if (!is_null(json_decode($user->observation)->departement) && in_array($this->id, json_decode($user->observation)->departement)) {
                array_push($members, $user);
            }
        }
        return $members;
        // return $this->hasMany(EmployeeDetails::class, 'department_id');
    }

}
