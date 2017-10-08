<?php

use App\Http\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
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
                    'username' => 'driver01',
                    'password' => Hash::make('password'),
                    'driver_id' => 1,
                    'passenger_id' => 0
                ]
            ],
            [
                'data' => [
                    'username' => 'passenger01',
                    'password' =>  Hash::make('password'),
                    'driver_id' => 0,
                    'passenger_id' => 1
                ]
            ]
        ];
        foreach ($records as $record) {
            $user = new User();
            $user->create($record['data']);
        }
    }
}
