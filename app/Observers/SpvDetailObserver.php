<?php

namespace App\Observers;

use App\SpvDetails;
use App\Notification;
use App\UniversalSearch;

class SpvDetailObserver
{

    /**
     * Handle the leave "saving" event.
     *
     * @param  \App\ClientDetails  $detail
     * @return void
     */
    public function saving(SpvDetails $detail)
    {
        // Cannot put in creating, because saving is fired before creating. And we need company id for check bellow
        if (company()) {
            $detail->company_id = company()->id;
        }
    }

    public function deleting(SpvDetails $detail)
    {
        $universalSearches = UniversalSearch::where('searchable_id', $detail->user_id)->where('module_type', 'client')->get();
        if ($universalSearches) {
            foreach ($universalSearches as $universalSearch) {
                UniversalSearch::destroy($universalSearch->id);
            }
        }
        $notifiData = ['App\Notifications\ClientPurchaseInvoice','App\Notifications\NewClientProposal','App\Notifications\NewClientTask','App\Notifications\NewContract'];

        $notifications = Notification::
        whereIn('type', $notifiData)
            ->whereNull('read_at')
            ->whereJsonContains('data->id', $detail->id)
            ->orwhereJsonContains('data->client_id', $detail->id)
            ->delete();
    }

}
