<?php

namespace App\Helpers;

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
}