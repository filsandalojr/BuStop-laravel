<?php

use App\Http\Models\Driver;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
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
                    'company_id' => 1,
                    'name' => 'Mr. Driver',
                    'age' => 30,
                    'address' => 'Cebu City, Cebu',
                    'rating' => 0
                ]
            ]
        ];
        foreach ($records as $record) {
            $driver = new Driver();
            $driver->create($record['data']);
        }
    }
}
