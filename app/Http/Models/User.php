<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'driver_id', 'passenger_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'token_auth',
    ];

    public function passenger()
    {
        return $this->hasOne(Passenger::class, 'id', 'passenger_id');
    }

    public function driver()
    {
        return $this->hasOne(Driver::class, 'id', 'driver_id');
    }
}
