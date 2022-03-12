<?php

namespace App;

use App\Scopes\CompanyScope;
use App\Observers\SupplierUserNotesObserver;

class SupplierUserNotes extends BaseModel
{
    protected $table = 'supplier_user_notes';
    protected $fillable = ['user_id', 'note_id'];

    protected static function boot()
    {
        parent::boot();
        static::observe(SupplierUserNotesObserver::class);
        static::addGlobalScope(new CompanyScope);
    }
}
