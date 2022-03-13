<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contect extends Model
{
    protected $fillable = ['gender','name','email','function','mobile','visibility','contect_type','user_id'];

    protected $appends = ['image_url'];

    public function clientdetail()
    {
        return $this->hasMany(clientdetail::class);
    }

    public function getImageUrlAttribute()
    {
        return ($this->image) ? asset_url('avatar/' . $this->image) : asset('img/default-profile-3.png');
    }


}


