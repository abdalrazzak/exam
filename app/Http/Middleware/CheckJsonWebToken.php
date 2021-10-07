<?php

namespace App\Http\Middleware;
 
use Closure;
use App\User;
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
            try {
              $user = JWTAuth::parseToken()->authenticate(); // you can use user any where
              
                return $next($request);
            }catch (TokenExpiredException $e) {
                //Thrown if token has expired
                return $this->error('419');
            }catch (TokenInvalidException $e) {
                //Thrown if token invalid
                return $this->error('420');
            }
            catch (JWTException $e) {
                //Thrown if token was not found in the request.
                return $this->error('421',$e->getMessage());
            }
  

    }
}
