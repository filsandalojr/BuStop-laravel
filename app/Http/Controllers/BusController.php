<?php

namespace App\Http\Controllers;

use App\Http\Models\Bus;
use App\Http\Models\BusTrip;
use Illuminate\Http\Request;

class BusController extends Controller
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


    public function illustrationChangingOfLocation() {
        $escarioArray = [
            [
                'lat' => '10.317690',
                'long'=> '123.895872'
            ],
            [
                'lat' => '10.317690',
                'long'=> '123.895872'
            ],
            [
                'lat' => '10.317615',
                'long'=> '123.895483'
            ],
            [
                'lat' => '10.317571',
                'long'=> '123.895074'
            ],
            [
                'lat' => '10.317508',
                'long'=> '123.894736'
            ],
            [
                'lat' => '10.317433',
                'long'=> '123.894449'
            ],
            [
                'lat' => '10.317364',
                'long'=> '123.894175'
            ],
            [
                'lat' => '10.317264',
                'long'=> '123.893926'
            ], [
                'lat' => '10.317169',
                'long'=> '123.893633'
            ],
            [
                'lat' => '10.317044',
                'long'=> '123.893231'
            ],
            [
                'lat' => '10.316845',
                'long'=> '123.892748'
            ],
            [
                'lat' => '10.316739',
                'long'=> '123.892351'
            ],
            [
                'lat' => '10.316535',
                'long'=> '123.891593'
            ],
            [
                'lat' => '10.316344',
                'long'=> '123.891057'
            ],
            [
                'lat' => '10.316193',
                'long'=> '123.890678'
            ],
            [
                'lat' => '10.316135',
                'long'=> '123.890231'
            ],
            [
                'lat' => '10.316135',
                'long'=> '123.890231'
            ],
            [
                'lat' => '10.317124',
                'long'=> '123.889770'
            ],
            [
                'lat' => '10.316987',
                'long'=> '123.889019'
            ],
            [
                'lat' => '10.316824',
                'long'=> '123.888504'
            ],
            [
                'lat' => '10.316671',
                'long'=> '123.888058'
            ],
            [
                'lat' => '10.316481',
                'long'=> '123.887495'
            ],
            [
                'lat' => '10.316328',
                'long'=> '123.887029'
            ],
            [
                'lat' => '10.315995',
                'long'=> '123.886229'
            ]
        ];
        foreach ($escarioArray as $arr) {
            $bus = BusTrip::find(1);
            $bus->location_lat = $arr['lat'];
            $bus->location_long = $arr['long'];
            $bus->save();

            sleep(6);
        }
    }
}
