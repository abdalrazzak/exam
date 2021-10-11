<?php

use App\App;
use App\User;
use App\Device;
use App\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 1000; $i++) {
            $uID = User::inRandomOrder()->first()->id  ;
            $appID =  App::inRandomOrder()->first()->id ; 
            $Subscriptions[] =   [
                'deviceID' => Device::inRandomOrder()->first()->id ,
                'expire_date'  => \Carbon\Carbon::now()->addMonth() , 
                'created_at'  => now(),
                'uID'   => $uID , 
                'appID' =>  $appID , 
            ];
        }

        $chunks = array_chunk($Subscriptions, 100);
        foreach ($chunks as $chunk) {
            Subscription::insert($chunk);
        }
    }
}
