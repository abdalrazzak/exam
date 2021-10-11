<?php

namespace App\Http\Controllers\API;

use App\App;
use App\User;
use App\Device;
use App\Subscription;
use App\Helpers\Helper;
use App\Traits\Responser;
use App\Events\StartEvent;
use Tymon\JWTAuth\JWTAuth ;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller; 
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Validator;
use App\Repository\Eloquent\AppRepository;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\DeviceRepository;
use App\Repository\Eloquent\SubscriptionRepository;

class AuthController extends Controller
{
    use Responser ;   

    public function register(RegisterRequest $request){ 
       // test appID number must be present in table apps . 
       // Note : you can take an ID from the table apps and try it
       if(!$this->isAppFound($request)){ // appId is not found return an error
         return $this->error('E006');
       } 
       DB::beginTransaction();
       try{
            $user = new UserRepository(new User());
            $user =  $user->create(['name' => $request->name , 'email' => $request->email , 'password' => Hash::make($request->password)]);
            $device = new DeviceRepository(new Device());   
            $device = $device->create([ 'token' =>  Helper::createToken()  , 'lang' => 'tr' , 'os' => 'ubuntu' ]); 
            if($this->isFoundSubscription($user , $device , $request)){ // One device can only have one subscription for one app.
                DB::rollback();
                return $this->error('E007');
            } 
            // after created trigger event start with observer
            $subscription = new SubscriptionRepository(new Subscription());
            $subscription->create(['deviceID' => $device->id , 'uID' => $user->id , 'appID' => $request->appID , 'expire_date' => date($request['expire_date'])]);
            DB::commit();
            return $this->data('device' , $device , 'has been created ');
       }catch(Exceptions $e){
             DB::rollback();
             return $this->error(500 , null , $e->getMessage());   
        }
    }  



    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request){
        try { 
             
            $credentials = $request->only(['email' , 'password']);

            $token = Auth::guard('api')->attempt($credentials);
            if (!$token){
                return $this->error('E001');
            }
            $user = Auth::guard('api')->user() ;  
 
            $device =  $this->getDevice( $request , $user);
            if(!$device){
                return $this->error('E003');
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

    public function getDevice( Request $request , $user){ 
        $subscription  = Subscription::active()->where([['appID' , $request->appID ] ,['deviceID' , $request->deviceID], ['uID' , $user->id  ] ])->first()  ;                
        if(!is_null($subscription)){
            return $subscription->device()->first();
        }
        return $subscription  ; 
    }
   
/**
     * check subscription is found or not .
     *
     * @param  Device $device
     * @param  User  $user
     * @param  Illuminate\Http\Request  $request
     * @return boolean
     */

    public function isFoundSubscription($user , $device , Request $request ){
        
        if(Subscription::isFound($user->id , $device->id , $request->appID)->first()){
            return true ; 
        }    
        return false  ; 
    }
    


    /**
     * check app is found . 
     * 
     * @param  Illuminate\Http\Request  $request
     * @return boolean
     */

    public function isAppFound(Request $request ){
        $app  = new AppRepository(new App()) ; 
        if(!is_null($app->find($request['appID']))){
            return true ; 
        } 
        return false  ; 
    }
    
 
}
