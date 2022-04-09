<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\DevicesTableSeeder;
use Database\Seeders\PlantDataSeeder;
use Database\Seeders\PlantAirHumiditySeeder;
use Database\Seeders\PlantSoilMoistureSeeder;
use Database\Seeders\PlantTemperatureSeeder;
use Database\Seeders\PlantSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\DevicesSeeder;
use Database\Seeders\WaterTimesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $seeds = [
            DevicesTableSeeder::class,
            PlantsCareSeeder::class,
            UsersTableSeeder::class,
            PlantSeeder::class,
            DevicesSeeder::class,
            PlantDataSeeder::class,
            PlantTemperatureSeeder::class,
            PlantSoilMoistureSeeder::class,
            PlantAirHumiditySeeder::class,
            WaterTimesSeeder::class
        ];

        $this->call($seeds);
    }
}
