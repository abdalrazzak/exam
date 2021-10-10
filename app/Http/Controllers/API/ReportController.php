<?php

namespace App\Http\Controllers\API;

use App\Subscription;
use App\Traits\Responser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    use Responser ; 

    // public $result_report = [ 
    //     'devices_expired' => [] ,    // expired devices
    //     'devices_unexpired' => []     // unexpired devices

    // ];
    // public $device_count_expired = 0 ; // counter for expierd subscription
    // public $device_count_unexpired = 0 ; // counter for unexpierd subscription

    public function report(Request $request){ 
       if(!isset($request->from) || !isset($request->to)){
            return  $this->error('E004');
       } 
       return $this->data('result_report' , $this->filter($request));
 
    }


    /** filter paramters 
     * 
     * $param $request 
     * @return Devices Returns expired devices
     */
    public function filter($request ){ 
       $device_count_expired = 0 ; // expired device count 
       $device_count_unexpired = 0 ; // unexpired device count 
       $devices_expired = [] ;   // expired device array 
       $devices_unexpired = [] ; // unexpired device  array
       $subscriptions =  Subscription::betweenDates([$request['from'] , $request['to']])->with('device')->get();
       foreach($subscriptions as $key => $subscription){
              if($subscription->active){
                   $devices_unexpired[] = $subscription->device ; 
                   $device_count_unexpired ++   ;  
               }else{
                   $devices_expired[]= $subscription->device ; 
                   $device_count_expired ++;  
               }
       } 
       return ['device_count_expired' => $device_count_expired , 'device_count_unexpired' => $device_count_unexpired  , 'devices_expired' => $devices_expired , 'devices_unexpired' => $devices_unexpired];
      }
}
