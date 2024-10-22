<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(DriverSeeder::class);
        $this->call(PassengerSeeder::class);
        $this->call(DestinationSeeder::class);
        $this->call(BusSeeder::class);
        $this->call(CompanySeeder::class);
    }
}
