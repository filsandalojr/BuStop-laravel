<?php

namespace App\Http\Controllers;

use App\Http\Models\Bus;
use App\Http\Models\BusTrip;
use App\Http\Models\Destination;
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

    public function initSearch()
    {
        $bus = Bus::all();
        $destination = Destination::all();

        $data = [
            'bus' => $bus,
            'destination' => $destination
        ];

        return response()->json($data);
    }

    public function searchTrip(Request $request)
    {
        $value = $request->all();

        $bus = Bus::where(['name'=> $value['bus'], 'type' => $value['type']]);
        $bus = $bus->with(
            [
                'busTrip' => function($q) use ($value) {
                    $q->where('destination_id', $value['destination']);
                }
            ]
        );
        $busTrip = $bus->get();
        $trips = [];

        foreach ($busTrip as $trip) {
            if ($trip->busTrip) {
                array_push($trips, $trip);
            }
        }

        return response()->json($trips);
    }

    public function bookTrip(Request $request)
    {

    }

}
