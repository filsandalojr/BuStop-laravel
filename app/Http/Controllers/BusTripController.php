<?php

namespace App\Http\Controllers;

use App\Http\Models\Bus;
use App\Http\Models\Destination;
use App\Http\Models\PassengerBooking;
use App\Http\Models\User;
use App\Http\Models\BusTrip;
use App\Http\Models\Driver;
use Illuminate\Http\Request;

class BusTripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getDestination()
    {
        $destination = Destination::get();

        return response()->json($destination);
    }

    public function newTrip($id, Request $request)
    {
        $value = $request->all();

        $user = User::with(
            [
                'driver' => function($q) {
                    $q->with('bus');
                }
            ]
        );
        $user = $user->find($id);

        $busTrip = new BusTrip();
        $busTrip->bus_id = $user->driver->bus['id'];
        $busTrip->destination_id = $value['destination'];
//        $busTrip->location_lat = '10.316148';
//        $busTrip->location_long = '123.886610';
        $busTrip->location_lat = '10.298383';
        $busTrip->location_long = '123.893305';
        $busTrip->available_seats = $user->driver->bus['capacity'];
        $busTrip->save();

        return response()->json($user);
    }

    public function searchTrips(Request $request)
    {

    }

    public function getPassengers($id, $tripId)
    {
        $passengers = PassengerBooking::where('bus_trip_id', $tripId)->get();
        $bustrip = BusTrip::find($tripId);
        $response = [
            'passenger' => $passengers,
            'available_seats' => $bustrip->available_seats
        ];
        return response()->json($response);
    }

    public function arrived(Request $request)
    {
        $value = $request->all();

        $trip = BusTrip::destroy($value['tripId']);
        return response()->json($trip);

    }

    public function boarded(Request $request)
    {
        $value = $request->all();

        $trip = BusTrip::find($value['tripId']);
        $trip->available_seats = $trip->available_seats - 1;
        $trip->save();

        return response()->json($trip);
    }
}
