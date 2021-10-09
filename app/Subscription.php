<?php

namespace App;

use App\Device;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions' ; 

    protected $guarded  = ['id'] ; 

    public function device(){
        return $this->belongsTo(Device::class , 'deviceID' , 'id') ;
    }
}
