<?php

namespace App\Listeners;

use App\Events\StartEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StartListener
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
     * @param  StartEvent  $event
     * @return void
     */
    public function handle(StartEvent $event)
    {
        // notify to user 
    }
}
