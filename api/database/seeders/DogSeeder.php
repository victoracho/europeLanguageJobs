<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dogs')->insert(
            ['breed' => 'Affenpinscher', 'size' => 'Pequeño', 'photo' => 'Affenpinscher.jpg', 'hair' => 'Negro', 'classifier_id' => 6],
        );
        DB::table('dogs')->insert(
            ['breed' => 'Beagle', 'size' => 'Mediano', 'photo' => 'Beagle.jpg', 'hair' => 'Marron', 'classifier_id' => 5],
        );
        DB::table('dogs')->insert(
            ['breed' => 'Pastor Australiano', 'size' => 'Grande', 'photo' => 'Pastor_australiano.jpg', 'hair' => 'Marron', 'classifier_id' => 1],
        );
        DB::table('dogs')->insert(
            ['breed' => 'Borzoi', 'size' => 'Grande', 'photo' => 'Borzoi.jpg', 'hair' => 'Marron',  'classifier_id' => 1],
        );
        DB::table('dogs')->insert(
            ['breed' => 'Boxer', 'size' => 'Grande', 'photo' => 'Boxer.jpg', 'hair' => 'Marron',  'classifier_id' => 4],
        );
        DB::table('dogs')->insert(
            ['breed' => 'Boston Bulldog', 'size' => 'Pequeño', 'photo' => 'Bostron_bulldog.jpg', 'hair' => 'Marron',  'classifier_id' => 3],
        );
        DB::table('dogs')->insert(
            ['breed' => 'English Bulldog', 'size' => 'Pequeño', 'photo' => 'English_bulldog.jpg', 'hair' => 'Marron',  'classifier_id' => 3],
        );
        DB::table('dogs')->insert(
            ['breed' => 'English Hound', 'size' => 'Mediano', 'photo' => 'English_hound.jpg', 'hair' => 'Marron',  'classifier_id' => 5],
        );
        DB::table('dogs')->insert(
            ['breed' => 'Malamute', 'size' => 'Grande', 'photo' => 'Malamute.jpg', 'hair' => 'Gris',  'classifier_id' => 7],
        );
        DB::table('dogs')->insert(
            ['breed' => 'Husky', 'size' => 'Grande', 'photo' => 'Husky.jpg', 'hair' => 'Gris',  'classifier_id' => 7],
        );
    }
}
