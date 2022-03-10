<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantsCareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path() . '/sql/plants_care.sql';
        DB::unprepared(file_get_contents($path));
        
        $this->command->info('✅ Plants Care table seeded succesfully!');
    }
}
