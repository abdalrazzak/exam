<?php

namespace App\Listeners;

use App\Events\SubscriptionEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatedSubscription
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SubscriptionEvent  $event
     * @return void
     */
    public function handle(SubscriptionEvent $event)
    {
        // sent to user notify
    }
}
