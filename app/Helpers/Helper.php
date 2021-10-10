<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;

class Helper
{

    const TOKEN_HANDLER = 'Bearer';
    const TOKEN_LENGTH = 255;

    /**
     * 255 string lingth 
     * 
     * @return string
     */
    public static function createToken()
    {
        return Str::random(self::TOKEN_LENGTH);
    }

    /**
     * check expire date for subscription
     * 
     * $param $date 
     * @return boolean
     */
    public static function checkExpireDate($expire_date){ // Returns true if the subscription has expired  , otherwise false
         
        $expire_date = Carbon::create($expire_date);
        $nowDate = Carbon::now();
        return $nowDate->gt($expire_date);
    }


     /**
     * return last char of string 
     * 
     * $param $string 
     * @return char
     */
    public static function getLastChar( String $string){ 
        return substr($string,-1);
    }

    /**
     *  code to check whether the number 
     *  is Even or Odd for odd true otherwise false
     * 
     * $param $number 
     * @return boolean 
     */
    public static function checkNumberOdd( int $number){ 
        return ($number % 2 != 0) ? true : false  ; 
    }
}