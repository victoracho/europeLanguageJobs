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
            ['breed' => 'Affenpinscher', 'size' => 'Pequeño', 'photo' => 'Affenpinscher', 'hair' => 'Negro', 'classifier_id' => 6],
            ['breed' => 'Beagle', 'size' => 'Mediano', 'photo' => 'Beagle', 'hair' => 'Marron', 'classifier_id' => 5],
            ['breed' => 'Pastor Australiano', 'size' => 'Grande', 'photo' => 'Pastor_australiano', 'hair' => 'Marron', 'classifier_id' => 1],
            ['breed' => 'Borzoi', 'size' => 'Grande', 'photo' => 'Borzoi', 'hair' => 'Marron',  'classifier_id' => 1],
            ['breed' => 'Boxer', 'size' => 'Grande', 'photo' => 'Boxer', 'hair' => 'Marron',  'classifier_id' => 4],
            ['breed' => 'Boxer', 'size' => 'Grande', 'photo' => 'Boxer', 'hair' => 'Marron',  'classifier_id' => 4],
            ['breed' => 'Boston Bulldog', 'size' => 'Pequeño', 'photo' => 'Boston_bulldog', 'hair' => 'Marron',  'classifier_id' => 3],
            ['breed' => 'English Bulldog', 'size' => 'Pequeño', 'photo' => 'English_bulldog', 'hair' => 'Marron',  'classifier_id' => 3],
            ['breed' => 'English Hound', 'size' => 'Mediano', 'photo' => 'English_bulldog', 'hair' => 'Marron',  'classifier_id' => 5],
            ['breed' => 'Malamute', 'size' => 'Grande', 'photo' => 'Malamute', 'hair' => 'Gris',  'classifier_id' => 7],
            ['breed' => 'Husky', 'size' => 'Grande', 'photo' => 'Husky', 'hair' => 'Gris',  'classifier_id' => 7],
        );
    }
}
