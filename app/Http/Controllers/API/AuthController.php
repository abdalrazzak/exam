<?php

namespace App\Http\Controllers\API;

use App\Traits\Responser;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;  
use App\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth ;

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
            $rule = [
                'email' => 'required' ,
                'password' => 'required'
            ];
            $validator = Validator::make($request->all(),$rule );
            if  ($validator->fails()){
                $code = $this->codeAccordingToInput($validator);
                return $this->ValidationError($code,$validator);
            }

            $credentials = $request->only(['email' , 'password']);

            $token = Auth::guard('api')->attempt($credentials);

            $user = Auth::guard('api')->user() ;

            if (!$token){
                return $this->error('E001');
            }
            $data = [
                'access_token' => $token ,
                'token_type' => 'bearer' ,
                'user' => $user
            ];
            return $this->data('data',$data);
        }catch(JWTException $e){
            return $this->error($e->getCode() , $e->getMessage() );
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
