<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\DevicesTableSeeder;
use Database\Seeders\UsersTableSeeder;

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
            UsersTableSeeder::class
        ];

        $this->call($seeds);
    }
}
