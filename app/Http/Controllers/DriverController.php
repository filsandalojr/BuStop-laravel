<?php

namespace App\Http\Controllers;

use Hash;
use App\Http\Models\Bus;
use App\Http\Models\Driver;
use App\Http\Models\Company;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Yaml\Tests\B;

class DriverController extends Controller
{
    public function index()
    {

    }

    public function getDetails()
    {
        return response()->json(Company::all());
    }

    public function registerDriver(Request $request)
    {
        $value = $request->all();

        $company = Company::find($value['company']);

        $driverData = [
            'company_id' => $value['company'],
            'name' => $value['driver_name'],
            'age' => $value['driver_age'],
            'address' => $value['driver_address'],
            'rating' => 0
        ];

        $busData = [
            'company_id' => $value['company'],
            'name' =>$company['name'],
            'bus_number' => $value['bus_number'],
            'capacity' => $value['capacity'],
            'type' => $value['bus_type'],
            'rating' => 0
        ];



        $driver = Driver::create($driverData);
        $bus = new Bus($busData);
        $driver->bus()->save($bus);

        $user = new User();
        $user->driver_id = $driver->id;
        $user->username = $value['username'];
        $user->password = Hash::make($value['password']);
        $user->save();

        return response()->json(['response' => 'success']);
    }
}
