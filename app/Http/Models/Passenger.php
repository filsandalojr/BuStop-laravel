<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $table = 'passengers';
    protected $fillable = ['name', 'contact_number'];

    public function user() {
        return $this->hasOne(User::class);
    }
}
