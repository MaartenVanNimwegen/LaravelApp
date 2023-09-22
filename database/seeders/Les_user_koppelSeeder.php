<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Les_user_koppelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('les_user_koppel')->insert([
            'userId' => 3,
            'lesId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('les_user_koppel')->insert([
            'userId' => 4,
            'lesId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('les_user_koppel')->insert([
            'userId' => 5,
            'lesId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('les_user_koppel')->insert([
            'userId' => 6,
            'lesId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('les_user_koppel')->insert([
            'userId' => 7,
            'lesId' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
