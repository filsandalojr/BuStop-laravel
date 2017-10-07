<?php

use App\Http\Models\Bus;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'data' => [
                    'driver_id' => 1,
                    'company_id' => 1,
                    'name' => 'Ceres Liner',
                    'bus_number' => '837',
                    'capacity' => 50,
                    'type' => 'aircon',
                    'rating' => 5
                ]
            ]
        ];
        foreach ($records as $record) {
            $bus = new Bus();
            $bus->create($record['data']);
        }
    }
}
