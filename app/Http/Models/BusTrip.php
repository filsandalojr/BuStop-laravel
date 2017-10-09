<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class BusTrip extends Model
{
    protected $table = 'bus_trip';
    //

    public function bus()
    {
        return $this->belongsTo(Bus::class,'bus_id','id');
    }
}
