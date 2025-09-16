<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentsTableSeeder extends Seeder
{
    public function run(): void
    {
        // مسح أي بيانات قديمة
        DB::table('enrollments')->delete();

        DB::table('enrollments')->insert([
            [
                'user_id' => 1, 
                'course_id' => 1,  
            ],
            [
                'user_id' => 1, 
                'course_id' => 2, 
            ],
        ]);
    }
}
