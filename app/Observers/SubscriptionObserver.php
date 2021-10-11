<?php

namespace App\Observers;

use App\Subscription;
use App\Events\SubscriptionEvent;
use App\Events\SubscriptionUpdatedEvent;

class SubscriptionObserver
{
     

     public function created(Subscription $subscription)
     {
         event(new SubscriptionEvent());
     }

     public function updated(Subscription $subscription)
     { 
         event(new SubscriptionUpdatedEvent()); // pass parameters and notify to user
     }
}
