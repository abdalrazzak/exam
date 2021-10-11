<?php

namespace App\Http\Requests;

use App\Traits\Responser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    use Responser ; 
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ 
            'email' => 'required' ,
            'password' => 'required' , 
            'appID'  => 'required' ,
            'deviceID'  => 'required' 
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = $this->error('E002' , null  , $errors->messages()) ;

        throw new HttpResponseException($response);
    }
}
