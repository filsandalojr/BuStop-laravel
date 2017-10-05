<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->integer('company_id')->references('id')->on('company')->onDelete('cascade');
            $table->string('name');
            $table->string('bus_number');
            $table->integer('capacity');
            $table->enum('type', array('aircon', 'normal'));
            $table->integer('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bus');
    }
}
