<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Enroll the logged-in student in a course
    public function store(Course $course)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login.form')->with('error', 'Please login to enroll.');
        }

        // already enrolled?
        if (Enrollment::where('user_id', $userId)->where('course_id', $course->id)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        // course full?
        if ($course->enrollments()->count() >= $course->max_students) {
            return redirect()->back()->with('error', 'This course is full.');
        }

        Enrollment::create([
            'user_id' => $userId,
            'course_id' => $course->id,
        ]);

        return redirect()->back()->with('success', 'Enrolled successfully.');
    }

    // Unenroll
    public function destroy(Course $course)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login.form')->with('error', 'Please login.');
        }

        Enrollment::where('user_id', $userId)
            ->where('course_id', $course->id)
            ->delete();

        return redirect()->back()->with('success', 'Unenrolled successfully.');
    }
}
