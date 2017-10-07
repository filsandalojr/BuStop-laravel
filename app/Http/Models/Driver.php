<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';
    //

    public function user() {
        return $this->belongsTo(User::class, 'id', 'driver_id');
    }

    public function bus() {
        return $this->belongsTo(Bus::class, 'id', 'driver_id');
    }
}
