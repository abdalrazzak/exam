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
}
