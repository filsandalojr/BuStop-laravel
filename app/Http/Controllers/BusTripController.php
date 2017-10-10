<?php

namespace App\Http\Controllers;

use App\Http\Models\Destination;
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
        $busTrip->location_lat = '10.298383';
        $busTrip->location_long = '123.893305';
        $busTrip->available_seats = $user->driver->bus['capacity'];
        $busTrip->save();

        return response()->json($user);
    }

    public function searchTrips(Request $request)
    {

    }
}
