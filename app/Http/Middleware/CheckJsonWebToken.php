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

            $token = $request->header(Helper::TOKEN_HANDLER , null);
            $device = Device::found((string) $token)->first();
            if ($device) {
                $subscription = $device->subscriptions()->getByAppId($request['appID'])->first() ;  
               
                $request['subscription'] = $subscription ;
               
                if(!isset($subscription->active) || !$subscription->active){
                    return $this->error('E003'); // Subscription expired
                }
                return $next($request);
            }  
            return $this->error('403'); // not found token 

    }
}
