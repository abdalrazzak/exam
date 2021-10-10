<?php

namespace App\Http\Controllers\API;

use App\Traits\Responser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    use Responser ; 


    public function report(Request $request){ 
       if(!isset($request->from)){
            return  $this->error('E004');
       }
       $result  = $this->filter($request) ; 
    }


    /** Returning devices with subscriptions expired or not
     * 
     * $param $request 
     * @return Device
     */
    public static function filter($request){ 
        return ($number % 2 != 0) ? true : false  ; 
    }
}
