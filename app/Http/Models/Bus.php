<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'bus';
    protected $fillable = ['company_id', 'name', 'bus_number', 'capacity', 'type'];

    public function busDriver() {
        return $this->belongsTo(Driver::class);
    }

    public function busTrip() {
        return $this->hasOne(BusTrip::class);
    }
}
