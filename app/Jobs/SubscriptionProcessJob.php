<?php

namespace App\Jobs;

use App\Subscription;
use App\Helpers\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable; 

class SubscriptionProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (Subscription::all() as $subscription){
            if(Helper::checkExpireDate($subscription->expire_date)){ // If expired update status and trigger event in observer
                $subscription->update(['active' => false ]) ;
            } 
        }
    }
}
