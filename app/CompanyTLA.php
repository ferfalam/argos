<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyTLA extends Model
{
    protected $fillable = [
        'type',
        'name',
        'slug'
    ];
}
