<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    protected $model = \App\Models\Enrollment::class;

    public function definition(): array
    {
        return [
            'user_id' => 1, 
            'course_id' => 1, 
        ];
    }
}
