<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_trip', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('bus_id')->references('id')->on('bus')->onDelete('cascade');
            $table->integer('destination_id')->references('id')->on('destination')->onDelete('cascade');
            $table->string('location_lat');
            $table->string('location_long');
            $table->integer('available_seats');

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
        Schema::drop('bus_trip');
    }
}
