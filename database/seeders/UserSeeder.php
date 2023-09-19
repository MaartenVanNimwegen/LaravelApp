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
            'password_code' => Hash::make('test'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Richard Kingma',
            'email' => 'rkingma@rocfriesepoort.nl',
            'password' => '$2y$10$dKgjhq4xiXt1aKZoN/L9IePt4GAzZ2zSSf87DjWmXAo4YdwjzNFde',
            'password_code' => Hash::make('test'),
            'role' => 'admin',
        ]);


        // STUDENTS
        DB::table('users')->insert([
            'name' => 'Maarten van Nimwegen',
            'email' => 'maarten@gmail.com',
            'password' => '$2y$10$dKgjhq4xiXt1aKZoN/L9IePt4GAzZ2zSSf87DjWmXAo4YdwjzNFde',
            'password_code' => Hash::make('test'),
            'role' => 'student',
        ]);   
        
        DB::table('users')->insert([
            'name' => 'Tim Hammersma',
            'email' => 'tim@gmail.com',
            'password' => '$2y$10$dKgjhq4xiXt1aKZoN/L9IePt4GAzZ2zSSf87DjWmXAo4YdwjzNFde',
            'password_code' => Hash::make('test'),
            'role' => 'student',
        ]);   

        DB::table('users')->insert([
            'name' => 'Kevin Kamstra',
            'email' => 'kevin@gmail.com',
            'password' => '$2y$10$dKgjhq4xiXt1aKZoN/L9IePt4GAzZ2zSSf87DjWmXAo4YdwjzNFde',
            'password_code' => Hash::make('test'),
            'role' => 'student',
        ]);   

        DB::table('users')->insert([
            'name' => 'Christian Koopman',
            'email' => 'christian@gmail.com',
            'password' => '$2y$10$dKgjhq4xiXt1aKZoN/L9IePt4GAzZ2zSSf87DjWmXAo4YdwjzNFde',
            'password_code' => Hash::make('test'),
            'role' => 'student',
        ]);   
    }
}