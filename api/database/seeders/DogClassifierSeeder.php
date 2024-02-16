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

        DB::table('dog_classifiers')->insert(
            ['name' => 'Buoy']
        );
        //3
        DB::table('dog_classifiers')->insert(
            ['name' => 'Bulldog']
        );
        //4
        DB::table('dog_classifiers')->insert(
            ['name' => 'Boxer']
        );

        //5
        DB::table('dog_classifiers')->insert(
            ['name' => 'Sabueso']
        );
        //6
        DB::table('dog_classifiers')->insert(
            ['name' => 'Pinscher/shnauzer']
        );
        //7
        DB::table('dog_classifiers')->insert(
            ['name' => 'nordico']
        );
        //8
        DB::table('dog_classifiers')->insert(
            ['name' => 'montañero']
        );
        //9
        DB::table('dog_classifiers')->insert(
            ['name' => 'Lebreles']
        );

        //10
        DB::table('dog_classifiers')->insert(
            ['name' => 'terrier']
        );
        //11
        DB::table('dog_classifiers')->insert(
            ['name' => 'Bull terrier']
        );
    }
}
