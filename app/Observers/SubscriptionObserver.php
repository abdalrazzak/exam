<?php

namespace App\Observers;

use App\Subscription;

class SubscriptionObserver
{
     

     public function created(Subscription $subscription)
     {
         event(new SubscriptionEvent());
     }

     public function updated(Subscription $subscription)
     {
         event(new SubscriptionEvent());
     }
}
