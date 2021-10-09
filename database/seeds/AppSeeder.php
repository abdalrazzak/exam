<?php

use App\App;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 1000; $i++) {
            $apps[] =   [
                'name'  =>  Str::random(20)  , // app name 
                'created_at'  =>  now()   
                
            ];
        }
        $chunks = array_chunk($apps, 100);

        foreach ($chunks as $chunk) {
            App::insert($chunk);
        }
    }
}
