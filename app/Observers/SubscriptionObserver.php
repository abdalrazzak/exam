<?php

namespace App\Observers;

use App\Subscription;

class SubscriptionObserver
{
     

     public function created(Subscription $subscription)
     {
         event(new SubscriptionEvent());
     }
}
