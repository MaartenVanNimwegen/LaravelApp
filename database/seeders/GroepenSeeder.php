<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroepenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('groep')->insert([
            'naam' => 'Team 1',
            'status' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep')->insert([
            'naam' => 'Team 2',
            'status' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep')->insert([
            'naam' => 'Team 3',
            'status' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('groep')->insert([
            'naam' => 'Team 4',
            'status' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep')->insert([
            'naam' => 'Team 5',
            'status' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
