<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Device extends Authenticatable
{
    protected $table  = 'devices' ;

    protected $guarded  = ['id']  ;

  
    public function scopeToken($query ,  $appID , $uID){
        return $query->where([['appID' , $appID ] , ['uID' , $uID]])->limit(1);
    }

    public function scopeFilter($query ,Array $filter){
        return $query->where($filter)->get();
    }
}
