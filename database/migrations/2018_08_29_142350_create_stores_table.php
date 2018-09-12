<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//    public function up()
//    {
//        Schema::create('stores', function (Blueprint $table) {
//            $table->increments('storeId');
//            $table->timestamps();
//            $table->string('name');
//            $table->string('phone', 10);
//            $table->string('address');
//            $table->double('loc_lat');
//            $table->double('lat_long');
//            $table->integer('managerId')->unsigned();
//            $table->foreign('managerId')->references('id')->on('managers');
//        });
//    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
