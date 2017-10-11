<?php

namespace App\Http\Controllers;

use App\Http\Models\Bus;
use App\Http\Models\BusTrip;
use App\Http\Models\Company;
use App\Http\Models\Destination;
use App\Http\Models\PassengerBooking;
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
        $bus = Company::all();
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

    public function bookTrip($id, Request $request)
    {
        $value = $request->all();
        $user = User::find($id);

        $busTrip = BusTrip::find($value['trip']);
        $busTrip->available_seats = $busTrip->available_seats - 1;
        $busTrip->update();

        $passengerTrip = [
            'bus_trip_id' => $value['trip'],
            'passenger_id' => $user->passenger_id,
            'location_lat' => $value['location_lat'],
            'location_long' => $value['location_long'],
            'upper' => $value['upper'],
            'upper_color' => $value['upper_color'],
            'lower' => $value['lower'],
            'lower_color' => $value['lower_color'],
            'landmark' => $value['landmark']
        ];

        $trip = PassengerBooking::create($passengerTrip);
        return response()->json($trip);
    }

    public function getBooking($id, $tripId)
    {
        $busTrip = BusTrip::with('bus')->find($tripId);

        return response()->json($busTrip);
    }

    public function cancelBooking($id)
    {
        $user = User::find($id);

        $trip = PassengerBooking::where('passenger_id', $user->passenger_id)->first();

        $trip->delete();
        return response()->json('success');
    }

}
