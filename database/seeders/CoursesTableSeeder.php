<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    public function run(): void
    {
       
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('courses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('courses')->insert([
            [
                'title' => 'Laravel Basics',
                'description' => 'Learn the basics of Laravel framework.',
                'start_date' => now(),
                'max_students' => 20,
                'instructor_id' => 2, 
            ],
            [
                'title' => ' PHP',
                'description' => ' Learn the basics of PHP',
                'start_date' => now(),
                'max_students' => 15,
                'instructor_id' => 2, 
            ],
        ]);
    }
}
