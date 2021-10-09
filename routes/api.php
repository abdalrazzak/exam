<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
 

Route::group(['prefix'=>'v1'  ,'namespace' =>'API'], function () {
    // 'check-json-web-token'
    Route::post('login', 'AuthController@login')->name('login'); 

    Route::group(['prefix'=>'/' , 'middleware' =>['check-json-web-token']],function(){
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::post('refresh', 'AuthController@refresh')->name('refresh');
        Route::post('me', 'AuthController@me')->name('me');
    }); 

});