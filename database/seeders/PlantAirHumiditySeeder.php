<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantAirHumiditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path() . '/sql/plants_umid_atm.sql';
        DB::unprepared(file_get_contents($path));
        
        $this->command->info('✅ Plants Air Humidity seeded succesfully!');
    }
}
