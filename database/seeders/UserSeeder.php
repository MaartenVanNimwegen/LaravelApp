<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Maarten',
            'email' => 'maarten@gmail.com',
            'password' => '$2y$10$dKgjhq4xiXt1aKZoN/L9IePt4GAzZ2zSSf87DjWmXAo4YdwjzNFde',
            'password_code' => Hash::make('test'),
            'role' => 'admin',
        ]);
    }
}