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
        // ADMINS
        DB::table('users')->insert([
            'name' => 'Frans de Boer',
            'email' => 'fdeboer@rocfriesepoort.nl',
            'password' => '$2y$10$dKgjhq4xiXt1aKZoN/L9IePt4GAzZ2zSSf87DjWmXAo4YdwjzNFde',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Richard Kingma',
            'email' => 'rkingma@rocfriesepoort.nl',
            'password' => '$2y$10$dKgjhq4xiXt1aKZoN/L9IePt4GAzZ2zSSf87DjWmXAo4YdwjzNFde',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // STUDENTS
        DB::table('users')->insert([
            'name' => 'Maarten van Nimwegen',
            'email' => 'maarten@gmail.com',
            'password' => '$2y$10$dKgjhq4xiXt1aKZoN/L9IePt4GAzZ2zSSf87DjWmXAo4YdwjzNFde',
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);   
        
        DB::table('users')->insert([
            'name' => 'Tim Hammersma',
            'email' => 'tim@gmail.com',
            'password' => '$2y$10$dKgjhq4xiXt1aKZoN/L9IePt4GAzZ2zSSf87DjWmXAo4YdwjzNFde',
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);   

        DB::table('users')->insert([
            'name' => 'Kevin Kamstra',
            'email' => 'kevin@gmail.com',
            'password' => '$2y$10$dKgjhq4xiXt1aKZoN/L9IePt4GAzZ2zSSf87DjWmXAo4YdwjzNFde',
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);   

        DB::table('users')->insert([
            'name' => 'Christian Koopman',
            'email' => 'christian@gmail.com',
            'password' => '$2y$10$dKgjhq4xiXt1aKZoN/L9IePt4GAzZ2zSSf87DjWmXAo4YdwjzNFde',
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]); 

        DB::table('users')->insert([
            'name' => 'Dinand Lieuwes',
            'email' => 'dinand@gmail.com',
            'password_code' => str::random(),
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);   
    }
}