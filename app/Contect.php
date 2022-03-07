<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contect extends Model
{
    protected $fillable = ['gender','name','email','function','mobile','visibility','contect_type','user_id'];


    public function clientdetail()
    {
        return $this->hasMany(clientdetail::class);
    }


}


