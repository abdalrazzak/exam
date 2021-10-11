<?php

namespace Tests\Unit;

use App\Device;
use Tests\TestCase;

class ApiTest extends TestCase
{

    public function test_register() {
            $result = $this->json('POST', '/api/v1/register', [
                "name" => "abd" ,
                "email" => "xFa22H323332301Sww@gmail.com" ,
                "password" => "password" ,
                "appID" => 1 , 
                "expire_date" => "2021-12-01" 
            ])->assertStatus(200);
    }

    public function test_login() {
        $result = $this->json('POST', '/api/v1/login', [
            "email" => "xFa22H323332301Sww@gmail.com" ,
            "password" => "password" ,
            "appID" => 1  , 
            "deviceID" =>  1014 
        ] )->assertStatus(200);
    }

    public function test_report() {
        // $device = Device::find(1);
        $result = $this->json('GET', '/api/v1/report', [
            "from" => "2021-10-05" ,
            "to" => "2021-12-11"  
        ])->assertSuccessful();
    }
   
    
 
}
