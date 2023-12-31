<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            LessenSeeder::class,
            GroepenSeeder::class,
            VragenSeeder::class,
            Groep_user_koppelSeeder::class,
            Les_user_koppelSeeder::class,
        ]);
    }
}
