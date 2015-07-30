<?php

namespace App\Listeners;

use App\Events\HookerBought;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserForHookerPurchase
{

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  HookerBought  $event
     * @return void
     */
    public function handle(HookerBought $event)
    {
        return 'hello';
    }
}
