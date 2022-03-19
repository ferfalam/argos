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

    public function canSee()
    {
        if ($this->visibility) {
            if ($this->visibility == "all") {
                return "all";
            } else {
                $users_id = json_decode($this->visibility);
                $users = array_map(function ($id) {
                    return User::find($id);
                }, $users_id);
                return $users;
            }
        }
        return '';
    }

}


