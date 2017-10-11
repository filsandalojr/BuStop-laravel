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
            $table->integer('bus_trip_id')->references('id')->on('bus_trip')->onDelete('cascade');
            $table->integer('passenger_id')->references('id')->on('passengers')->onDelete('cascade');
            $table->string('location_lat');
            $table->string('location_long');
            $table->string('upper');
            $table->string('upper_color');
            $table->string('lower');
            $table->string('lower_color');
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
