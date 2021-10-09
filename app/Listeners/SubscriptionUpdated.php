<?php

namespace App\Listeners;

use App\Events\SubscriptionUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubscriptionUpdated
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
     * @param  SubscriptionUpdatedEvent  $event
     * @return void
     */
    public function handle(SubscriptionUpdatedEvent $event)
    {
        //
    }
}
