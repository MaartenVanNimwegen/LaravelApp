<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Groep_user_koppelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('groep_user_koppel')->insert([
            'userId' => 3,
            'groepId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('groep_user_koppel')->insert([
            'userId' => 4,
            'groepId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 5,
            'groepId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 6,
            'groepId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 7,
            'groepId' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('groep_user_koppel')->insert([
            'userId' => 8,
            'groepId' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 9,
            'groepId' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 12,
            'groepId' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
