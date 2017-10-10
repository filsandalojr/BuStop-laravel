<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PassengerBooking extends Model
{
    protected $table = 'passengers_booking';
    protected $fillable = ['passenger_id', 'bus_id', 'location_lat', 'location_long', 'upper', 'upper_color', 'lower', 'lower_color', 'landmark'];
}
