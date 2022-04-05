<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create([
            'name' => 'Vlad Botar',
            'email' => 'vlad.botar99@yahoo.com'
        ]);

        $this->command->info('✅ Users seeded succesfully.');
    }
}
