<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Device;
use App\Helpers\Helper;
use App\Traits\Responser;
use Tymon\JWTAuth\JWTAuth ;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repository\Eloquent\DeviceRepository;

class AuthController extends Controller
{
    use Responser ;   

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        try { 

            if(!isset($request->appID)){ // these are parameters for developer
                return $this->error('E002');
            }
            $credentials = $request->only(['email' , 'password']);

            $token = Auth::guard('api')->attempt($credentials);

            $user = Auth::guard('api')->user() ; 
            
            $check = Device::token( $request->appID, $user->id )->exists()  ; // Is there a device ? return true if there is otherwise false

            $device =  $this->getDevice($check , $request , $user);

            if (!$token){
                return $this->error('E001');
            }
            $data = [
                'token_type' => 'bearer' ,
                'device' => $device
            ];
            return $this->data('data',$data);
        }catch(JWTException $e){
            return $this->error($e->getCode() , $e->getMessage() );
        }
    }


     /**
     * Get the Device.
     *
     * @param $check boolean
     * @return \Illuminate\Http\JsonResponse
     */

    public function getDevice($check , Request $request , $user){
        $deviceReqpository  = new DeviceRepository(new Device()) ; 
        if(!$check){
            $token_device  = Helper::createToken() ; 
            $device =  $deviceReqpository->create(['uID' => $user->id , 'appID' => $request->appID , 'token' =>  $token_device  , 'lang' => $request->lang , 'os' => $request->os ]);        
        }else{
            $device  = Device::where([['appID' , $request->appID ] , ['uID' , $user->id  ] ])->first() ;                
        } 
        return $device  ; 
    }
   
 
 
}
