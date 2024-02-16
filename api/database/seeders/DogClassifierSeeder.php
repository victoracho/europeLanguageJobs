<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DogClassifierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //1
        DB::table('dog_classifiers')->insert(
            ['name' => 'pastor']
        );
        //2

        DB::table('roles_permissions')->insert(
            ['name' => 'Buoy']
        );
        //3
        DB::table('roles_permissions')->insert(
            ['name' => 'Bulldog']
        );
        //4
        DB::table('roles_permissions')->insert(
            ['name' => 'Boxer']
        );

        //5
        DB::table('roles_permissions')->insert(
            ['name' => 'Sabueso']
        );
        //6
        DB::table('roles_permissions')->insert(
            ['name' => 'Pinscher/shnauzer']
        );
        //7
        DB::table('roles_permissions')->insert(
            ['name' => 'nordico']
        );
        //8
        DB::table('roles_permissions')->insert(
            ['name' => 'montañero']
        );
        //9
        DB::table('roles_permissions')->insert(
            ['name' => 'Lebreles']
        );

        //10
        DB::table('roles_permissions')->insert(
            ['name' => 'terrier']
        );
        //11
        DB::table('roles_permissions')->insert(
            ['name' => 'Bull terrier']
        );
    }
}
