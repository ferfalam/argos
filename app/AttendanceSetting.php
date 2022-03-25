<?php

namespace App;

use App\Observers\AttendanceSettingObserver;
use App\Scopes\CompanyScope;

class AttendanceSetting extends BaseModel
{

    protected $table = 'attendance_settings';

    protected static function boot()
    {
        parent::boot();

        static::observe(AttendanceSettingObserver::class);

        // static::addGlobalScope(new CompanyScope);

    }

}
