<?php

namespace Database\Seeders;

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
        $this->call(DogClassifierSeeder::class);
        $this->call(DogSeeder::class);
        $this->call(UserSeeder::class);
    }
}
