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
            'password' => Hash::make('Test1234!'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Richard Kingma',
            'email' => 'rkingma@rocfriesepoort.nl',
            'password' => Hash::make('Test1234!'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // STUDENTS
        DB::table('users')->insert([
            'name' => 'Maarten van Nimwegen',
            'email' => 'maarten@gmail.com',
            'password' => Hash::make('Test1234!'),
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);   
        
        DB::table('users')->insert([
            'name' => 'Tim Hammersma',
            'email' => 'tim@gmail.com',
            'password' => Hash::make('Test1234!'),
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);   

        DB::table('users')->insert([
            'name' => 'Kevin Kamstra',
            'email' => 'kevin@gmail.com',
            'password' => Hash::make('Test1234!'),
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);   

        DB::table('users')->insert([
            'name' => 'Christian Koopman',
            'email' => 'christian@gmail.com',
            'password' => Hash::make('Test1234!'),
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]); 

        DB::table('users')->insert([
            'name' => 'Dinand Lieuwes',
            'email' => 'dinand@gmail.com',
            'password' => Hash::make('Test1234!'),
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);  

        DB::table('users')->insert([
            'name' => 'Martijn Graafsma',
            'email' => 'martijn@gmail.com',
            'password' => Hash::make('Test1234!'),
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);  

        DB::table('users')->insert([
            'name' => 'Remon Dollenkamp',
            'email' => 'remon@gmail.com',
            'password' => Hash::make('Test1234!'),
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);  

        DB::table('users')->insert([
            'name' => 'Jesper Minks',
            'email' => 'jesper@gmail.com',
            'password' => Hash::make('Test1234!'),
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);  

        DB::table('users')->insert([
            'name' => 'Tobias van Spanning',
            'email' => 'tobias@gmail.com',
            'password' => Hash::make('Test1234!'),
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);  

        DB::table('users')->insert([
            'name' => 'Arwin Walsweer',
            'email' => 'arwin@gmail.com',
            'password' => Hash::make('Test1234!'),
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);  

        DB::table('users')->insert([
            'name' => 'Shibin Pan',
            'email' => 'shibin@gmail.com',
            'password' => Hash::make('Test1234!'),
            'role' => 'student',
            'klas' => 'SEITO21A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}