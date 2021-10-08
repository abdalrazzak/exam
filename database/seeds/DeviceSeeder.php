<?php

use App\App;
use App\User;
use App\Device;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         

        for ($i=0; $i < 1000; $i++) {
            $devices[] =   [
                'token' => Str::random(config('token.token_length')) , 
                'uID'   =>  User::inRandomOrder()->first()->id  , 
                'appID' =>  App::inRandomOrder()->first()->id , 
                'lang'  =>  'en_GB'  , // We can put the languages in a table 
                'os'    =>  'ubuntu' 
            ];
        }
        $chunks = array_chunk($devices, 100);

        foreach ($chunks as $chunk) {
            Device::insert($chunk);
        }
         
       
    }
}
