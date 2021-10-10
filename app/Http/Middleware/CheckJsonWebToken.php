<?php

namespace App\Http\Middleware;
 
use Closure;
use App\User;
use App\Device;
use App\Helpers\Helper;
use App\Traits\Responser;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class CheckJsonWebToken
{
    use Responser ;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        //   $user = JWTAuth::parseToken()->authenticate(); // you can use user any where
            $token = $request->header(Helper::TOKEN_HANDLER , null);
            $check = Device::found((string) $token)->exists();
            if ($check) {
                $subscription = Device::where('token' , '=' , $token)->first()->subscription()->first() ;  
                $request['subscription'] = $subscription ;
               
                if(!$subscription->active){
                    return $this->error('E003'); // Subscription expired
                }
                return $next($request);
            }  
            return $this->error('403'); // not found token 

    }
}
