<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
   public function run(): void
{

    DB::table('users')->insert([
        [
            'name' => 'Ahmed Ali',
            'email' => 'ahmed@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ],
        [
            'name' => 'Ali Khaled',
            'email' => 'Ali@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'instructor',
        ],
    ]);
}
}
