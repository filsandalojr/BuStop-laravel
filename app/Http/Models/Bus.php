<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    public function busDriver() {
        return $this->belongsTo(Driver::class);
    }
}
