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
    }
}
