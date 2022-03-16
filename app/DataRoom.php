<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DataRoom extends Model
{
    use Notifiable;

    /**
     * Get the user that owns the DataRoom
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return User::find($this->user_id);
    }

    /**
     * Get the file that owns the DataRoom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function file()
    {
        $file_url = $this->type == "task" ? TaskFile::find($this->file_id) : SubTaskFile::find($this->file_id);
        return $file_url;
    }

    public function canSee()
    {
        if ($this->visible_by) {
            if ($this->visible_by == "all") {
                return "all";
            }else{
                $users_id = json_decode($this->visible_by);
                $users = array_map(function ($id)
                    {
                        return User::find($id);
                    }, $users_id);
                return $users;
            }
        }
        return '';
    }

    /**
     * Get the espace associated with the DataRoom
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function espace()
    {
        return Espace::find($this->espace_id);
    }

    public function last_update_user()
    {
        return User::find($this->last_update_user_id);
    }

    public static function canPublish()
    {
        return DataRoom::where("publish", 1);
    }

    public static function canNotPublish()
    {
        return DataRoom::where("publish", 0);
    }


}
