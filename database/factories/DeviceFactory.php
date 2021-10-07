<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Device;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
    return [
        'token' => Str::random(config('token.token_length')) , 
        'uID'   =>  User::inRandomOrder()->first()->id  , 
        'appID' =>  rand(1,100) , 
        'lang'  =>  'en_GB'  , // We can put the languages in a table 
        'os'    =>  'ubuntu' 
    ];
});
