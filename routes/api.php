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
    Route::get('report', 'ReportController@report')->name('report'); 
    Route::post('login', 'AuthController@login')->name('login'); 

    Route::group(['prefix'=>'/' , 'middleware' => ['check-token']],function(){
        Route::post('payment', 'PaymentController@payment')->name('payment'); 
    }); 

});