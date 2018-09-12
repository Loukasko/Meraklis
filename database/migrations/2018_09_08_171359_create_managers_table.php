<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->rememberToken();
            $table->string('name');
            $table->string('surname');
            $table->string('username');
            $table->string('password');
            $table->string('AFM',10);
            $table->string('AMKA',11);
            $table->string('IBAN',27);
            $table->float('salary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('managers');
    }
}
