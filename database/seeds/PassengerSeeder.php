<?php

use App\Http\Models\Passenger;
use Illuminate\Database\Seeder;

class PassengerSeeder extends Seeder
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
                    'name' => 'Im A Passenger',
                    'contact_number' => '09123456789'
                ]
            ]
        ];
        foreach ($records as $record) {
            $passenger = new Passenger();
            $passenger->create($record['data']);
        }
    }
}
