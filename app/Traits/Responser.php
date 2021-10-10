<?php 

namespace App\Traits ; 

trait Responser { 

    public $data = [
        'error'    => false , 
        'http_code'   => 200 , 
        'err_num'  => null , 
        'msg'      => null  
    ];

    public $text_error = [
        '419'    => 'Your token has expired. Please, login again', 
        '420'    => 'Your token is invalid. Please, login again' ,
        '403'    => 'Token is not found ' ,
        'E001'       => 'this email or password incorrect'  , 
        'E002'       => 'Server Error'  , 
        'E003'       => 'Subscription expired'  , 
        'E004'       => 'There are no parameters to process'  , 
        'E005'       => 'Invalid payment'  , 
        'E006'       => 'Invalid payment'  , 

    ];
 
      

    /**
     * Handle an error request 
     *
     * @param $code
     * @param $msg nullable
     * @return response
     */
    public function error($code , $msg = null ){
            $this->data['error'] = true ; 
            $this->data['http_code'] = $code ; 
            $this->data['err_num'] = $code ; 
            $this->data['msg'] = (!is_null($msg)) ? $msg : $this->text_error[$code] ; 
        return $this->responseData($this->data);
    }

  

    /**
     * Handle a data request 
     *
     * @param $key     You can give any name to the returned data 
     * @param $value   returned data
     * @param $msg     You can return any message
     * @return response
     */
    public function data($key , $value , $msg = null){
        (!is_null($msg)) ? $this->data['msg'] = $msg : null  ;
        $this->data[$key] = $value;
        return $this->responseData($this->data);
    }

    /**
     * Return response data
     * 
     * @param Array $data      
     * @return response
     */
    private function responseData(Array $data){ 
        return response()->json($data);
    }
 
 


  
 


}