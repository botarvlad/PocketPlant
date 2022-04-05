<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PlantSoilMoistureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path() . '/sql/plants_umid_sol.sql';
        DB::unprepared(file_get_contents($path));
        
        $this->command->info('✅ Plants Soil Moisture seeded succesfully!');
    }
}
