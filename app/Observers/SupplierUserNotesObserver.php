<?php

namespace App\Observers;

use App\Http\Controllers\Admin\AdminBaseController;
use App\SupplierUserNotes;
use App\Scopes\CompanyScope;
use Illuminate\Support\Facades\Notification;

class SupplierUserNotesObserver
{

    /**
     * Handle the notice "saving" event.
     *
     * @param  \App\Notice  $notice
     * @return void
     */
    public function saving(SupplierUserNotes $notes)
    {
        if (company()) {
            $notes->company_id = company()->id;
        }
    }

    public function created(SupplierUserNotes $notes)
    {
        //
    }

}