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
                    'password' => '$2y$10$TBsFHKHiANV.uodZ0VjZ4exGO1m33kY599AVF1UNJeZKC4OAHOWcy',
                    'driver_id' => 1,
                    'passenger_id' => 0
                ]
            ],
            [
                'data' => [
                    'username' => 'passenger01',
                    'password' => '$2y$10$TBsFHKHiANV.uodZ0VjZ4exGO1m33kY599AVF1UNJeZKC4OAHOWcy',
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
