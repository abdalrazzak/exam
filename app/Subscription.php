<?php

namespace App;

use App\Device;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions' ; 

    protected $guarded  = ['id'] ;
    
    public function scopeActive($query){
        return $query->where('active'  ,true);
    }

    public function device(){
        return $this->belongsTo(Device::class , 'deviceID' , 'id') ;
    }
    
    public function scopeBetweenDates($query , Array $dates){
        return $query->whereBetween('expire_date' , $dates) ;
    }

    public function scopeIsFound($query ,$user_id , $device_id , $app_id){
        return $query->where([['uID' , $user_id ] , ['deviceID' , $device_id] , ['appID' , $app_id] ]) ;
    }

    public function scopeGetByAppId($query , $appID){
        return $query->where('appId' , $appID);
    }
    
}
