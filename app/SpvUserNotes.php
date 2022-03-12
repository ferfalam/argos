<?php

namespace App;

use App\Scopes\CompanyScope;
use App\Observers\SpvUserNotesObserver;

class SpvUserNotes extends BaseModel
{
    protected $table = 'spv_user_notes';
    protected $fillable = ['user_id', 'note_id'];

    protected static function boot()
    {
        parent::boot();
        static::observe(SpvUserNotesObserver::class);
        static::addGlobalScope(new CompanyScope);
    }
}
