<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VragenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vragen')->insert([
            'vraag' => 'Ik begrijp het principe OOP niet, zou u daar een uitleg over kunnen geven?',
            'status' => '0',
            'userId' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('vragen')->insert([
            'vraag' => 'Hoe stel ik een goede user tabel nu precies op met database structure?',
            'status' => '0',
            'userId' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('vragen')->insert([
            'vraag' => 'Wat is over erving?',
            'status' => '0',
            'userId' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
