<?php

namespace App\Observers;

use App\OfflinePaymentMethod;
use Illuminate\Support\Facades\Auth;

class OfflinePaymentMethodObserver
{

    public function saving(OfflinePaymentMethod $paymentMethod)
    {
        // Cannot put in creating, because saving is fired before creating. And we need company id for check bellow
        if (company() && Auth::user()->super_admin !=1) {
            $paymentMethod->company_id = company()->id;
        }
    }

}
