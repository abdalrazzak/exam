<?php

namespace App\Providers;

use App\Events\StartEvent;
use App\Listeners\StartListener;
use App\Events\SubscriptionEvent;
use Illuminate\Support\Facades\Event;
use App\Listeners\CreatedSubscription;
use Illuminate\Auth\Events\Registered;
use App\Events\SubscriptionUpdatedEvent;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SubscriptionEvent::class => [
            CreatedSubscription::class
        ] , 
        SubscriptionUpdatedEvent::class => [
            SubscriptionUpdatedListener::class
        ],
        StartEvent::class => [
            StartListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
