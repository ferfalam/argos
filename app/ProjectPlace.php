<?php

namespace App;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class ProjectPlace extends Model
{
    protected $table = 'project_places';

    protected static function boot()
    {
        parent::boot();


        static::addGlobalScope(new CompanyScope);
    }
}
