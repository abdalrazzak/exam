<?php

namespace App\Http\Requests;

use App\Traits\Responser;
use Illuminate\Foundation\Http\FormRequest;  
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'name' => 'required' , 
            'email' => 'required|unique:users' ,
            'password' => 'required' , 
            'appID'  => 'required' ,
            'expire_date'  => 'required|date_format:Y-m-d'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = $this->error('E002' , null  , $errors->messages()) ;

        throw new HttpResponseException($response);
    }

}
