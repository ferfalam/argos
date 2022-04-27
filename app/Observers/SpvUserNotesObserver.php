<?php

namespace App\Observers;

use App\Http\Controllers\Admin\AdminBaseController;
use App\SpvUserNotes;
use App\Scopes\CompanyScope;
use Illuminate\Support\Facades\Notification;

class SpvUserNotesObserver
{

    /**
     * Handle the notice "saving" event.
     *
     * @param  \App\Notice  $notice
     * @return void
     */
    public function saving(SpvUserNotes $notes)
    {
        if (company()) {
            $notes->company_id = company()->id;
        }
    }

    public function created(SpvUserNotes $notes)
    {
        //
    }

}