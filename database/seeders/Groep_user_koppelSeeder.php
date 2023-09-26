<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Groep_user_koppelSeeder extends Seeder
{
    public function run(): void
    {
        // Team 9.1
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

        // Team 9.2
        DB::table('groep_user_koppel')->insert([
            'userId' => 9,
            'groepId' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 11,
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

        // Team 8.1
        DB::table('groep_user_koppel')->insert([
            'userId' => 3,
            'groepId' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 7,
            'groepId' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 11,
            'groepId' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Team 8.2
        DB::table('groep_user_koppel')->insert([
            'userId' => 5,
            'groepId' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 6,
            'groepId' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 10,
            'groepId' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 12,
            'groepId' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Team 8.3
        DB::table('groep_user_koppel')->insert([
            'userId' => 4,
            'groepId' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 8,
            'groepId' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('groep_user_koppel')->insert([
            'userId' => 9,
            'groepId' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}