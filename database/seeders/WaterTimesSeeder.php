<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaterTimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path() . '/sql/water_times.sql';
        DB::unprepared(file_get_contents($path));

        $this->command->info('✅ Water Times seeded succesfully.');
    }
}
