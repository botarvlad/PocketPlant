<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\DevicesTableSeeder;
use Database\Seeders\PlantDataSeeder;
use Database\Seeders\PlantSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\DevicesSeeder;

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
            UsersTableSeeder::class,
            DevicesSeeder::class,
            PlantSeeder::class,
            PlantDataSeeder::class,
        ];

        $this->call($seeds);
    }
}
