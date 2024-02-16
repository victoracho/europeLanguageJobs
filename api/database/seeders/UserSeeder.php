<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            ['firstnames' => 'Pedro', 'lastnames' => 'Perez Delgado', 'role' => 'User', 'email' => 'pedro@gmail.com', 'password' => bcrypt('12345')],
            ['firstnames' => 'Diego', 'lastnames' => 'Pereira Gonzalez', 'role' => 'Admin', 'email' => 'pedro@gmail.com', 'password' => bcrypt('12345')],
        );
    }
}
