<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'min' => '1',
            'max' => '20',
        ]);

        DB::table('les')->insert([
            'naam' => 'Basis database structure',
            'info' => 'Basiskennis database structuring',
            'klas' => 'SEITO21A',
            'start' => '2023-11-29 13:00:00',
            'min' => '1',
            'max' => '20',
        ]);  
    }
}
