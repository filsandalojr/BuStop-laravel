<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';
    protected $fillable = ['company_id', 'name', 'age', 'address', 'rating'];
    //

    public function user() {
        return $this->hasOne(User::class);
    }

    public function bus() {
        return $this->hasOne(Bus::class);
    }
}
