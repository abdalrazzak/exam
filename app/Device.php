<?php

namespace App;

use App\User;
use App\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Device extends Authenticatable
{
    protected $table  = 'devices' ;

    protected $guarded  = ['id']  ;

  
    public function scopeToken($query ,  $appID = null  , $uID = null ){
        return $query->where([['appID' , $appID ] , ['uID' , $uID]])->limit(1);
    }

    public function scopeFound($query , $token ){
        return $query->where('token' ,'=', $token);
    }
 
    


    public function scopeFilter($query ,Array $filter){
        return $query->where($filter)->get();
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class , 'deviceID' , 'id');
    }


 
}
