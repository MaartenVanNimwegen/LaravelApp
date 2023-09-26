<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroepenSeeder extends Seeder
{
    public function run(): void
    {
        // Active groepen
        DB::table('groep')->insert([
            'naam' => 'Team 9.1',
            'status' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep')->insert([
            'naam' => 'Team 9.2',
            'status' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Inactive groepen
        DB::table('groep')->insert([
            'naam' => 'Team 8.1',
            'status' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep')->insert([
            'naam' => 'Team 8.2',
            'status' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep')->insert([
            'naam' => 'Team 8.3',
            'status' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
