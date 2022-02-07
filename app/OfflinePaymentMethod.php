<?php

namespace App;

use App\Observers\OfflinePaymentMethodObserver;
use App\Scopes\CompanyScope;
use Illuminate\Support\Facades\Auth;

class OfflinePaymentMethod extends BaseModel
{
    protected $table = 'offline_payment_methods';
    protected $dates = ['created_at'];

    protected static function boot()
    {
        parent::boot();

        static::observe(OfflinePaymentMethodObserver::class);
        if (Auth::user()->super_admin != 1) {
            static::addGlobalScope(new CompanyScope);
        }
    }

    public static function activeMethod()
    {
        return OfflinePaymentMethod::where('status', 'yes')->get();
    }

}
