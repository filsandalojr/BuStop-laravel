<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePassengersBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers_booking', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('bus_id')->references('id')->on('bus')->onDelete('cascade');
            $table->integer('passenger_id')->references('id')->on('passengers')->onDelete('cascade');
            $table->float('location_lat');
            $table->float('location_long');
            $table->string('landmark');
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
        Schema::drop('passengers_booking');
    }
}
