<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//    public function up()
//    {
//        Schema::create('store_products', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('storeId')->unsigned();
//            $table->foreign('storeId')->references('storeId')->on('stores');
//            $table->integer('productId')->unsigned();
//            $table->foreign('productId')->references('id')->on('products');
//            $table->integer('stock');
//            $table->timestamps();
//        });
//    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_products');
    }
}
