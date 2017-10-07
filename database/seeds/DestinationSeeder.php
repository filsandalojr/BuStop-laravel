<?php

use App\Http\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
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
                    'destination' => 'Oslob',
                    'via' => 'Bato'
                ]
            ],
            [
                'data' => [
                    'destination' => 'Oslob',
                    'via' => 'Barili'
                ]
            ]
        ];
        foreach ($records as $record) {
            $destination = new Destination();
            $destination->create($record['data']);
        }
    }
}
