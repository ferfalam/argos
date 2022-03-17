<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataRoomHistory extends Model
{
    

    public function user()
    {
        return User::find($this->user_id);
    }

    public function doc()
    {
        return DataRoom::find($this->data_room_id);
    }
}
