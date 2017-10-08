<?php

namespace App\Http\Controllers;

use Hash;
use App\Http\Models\Passenger;
use App\Http\Models\User;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index()
    {

    }

    public function registerUser(Request $request)
    {
        $value = $request->all();

        $passengerData = [
            'name' => $value['name'],
            'contact_number' => $value['contact_number']
        ];
        $passenger = Passenger::create($passengerData);

        $user = new User();
        $user->passenger_id = $passenger->id;
        $user->username = $value['username'];
        $user->password = Hash::make($value['password']);
        $user->save();

        return response()->json(['response' => 'success']);
    }

}
