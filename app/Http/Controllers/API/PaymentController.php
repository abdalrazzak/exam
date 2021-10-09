<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helper;
use App\Traits\Responser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    use Responser ; 
    public function payment(Request $request){  // String checking  $receipt_string
        if(!isset($request->receipt_string)){
            return $this->error('E004'); // There are no parameters to process
        }
        $last_char  = (int) Helper::getLastChar((string)$request->receipt_string); // get last char
         // return success if number is odd otherwise error
        return (Helper::checkNumberOdd($last_char)) ? $this->data('subscription' , $request->subscription , 'payment has been successfull') : $this->error('E005') ;
    }
}
