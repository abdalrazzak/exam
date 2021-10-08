<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token')->unique()->nullable();
            $table->bigInteger('uID')->unsigned()->index('uID');
            $table->bigInteger('appID')->unsigned()->index('appID'); 
            $table->string('lang')->nullable(); 
            $table->string('os')->nullable(); 
            $table->timestamps();

            $table->foreign('uID')->references('id')->on('users')->onDelete('cascade') ;
            $table->foreign('appID')->references('id')->on('apps')->onDelete('cascade') ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
