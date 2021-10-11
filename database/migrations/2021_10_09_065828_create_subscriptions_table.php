<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('deviceID')->unsigned()->index('deviceID');
            $table->bigInteger('uID')->unsigned()->index('uID');
            $table->bigInteger('appID')->unsigned()->index('appID'); 
            $table->date('expire_date')->nullable()->index('expire_date');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('deviceID')->references('id')->on('devices')->onDelete('cascade') ;
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
        Schema::dropIfExists('subscriptions');
    }
}
