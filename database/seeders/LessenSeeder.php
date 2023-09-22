<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('les')->insert([
            'naam' => 'Basis OOP',
            'info' => 'De basis van object oriented programming',
            'klas' => 'SEITO21A',
            'start' => '2023-11-29 12:10:00',
            'min' => '5',
            'max' => '10',
        ]);

        DB::table('les')->insert([
            'naam' => 'Basis database structure',
            'info' => 'Basiskennis database structuring',
            'klas' => 'SEITO21A',
            'start' => '2023-11-29 13:00:00',
            'min' => '5',
            'max' => '15',
        ]);  

        DB::table('les')->insert([
            'naam' => 'Gevorderd database structure',
            'info' => 'Basiskennis vereist',
            'klas' => 'SEITO21A',
            'start' => '2023-12-01 13:00:00',
            'min' => '5',
            'max' => '10',
        ]);
        
        DB::table('les')->insert([
            'naam' => 'Gevorderd OOP',
            'info' => 'Basiskennis vereist',
            'klas' => 'SEITO21A',
            'start' => '2023-12-2 13:00:00',
            'min' => '5',
            'max' => '10',
        ]);
    }
}
