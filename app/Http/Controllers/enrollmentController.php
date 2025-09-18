<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class EnrollmentController extends Controller
{
    
    public function store(Course $course)
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login to enroll.');
        }

      
        if (Enrollment::where('user_id', $userId)->where('course_id', $course->id)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

       
        if ($course->enrollments()->count() >= $course->max_students) {
            return redirect()->back()->with('error', 'This course is full.');
        }

        Enrollment::create([
            'user_id' => $userId,
            'course_id' => $course->id,
        ]);

        return redirect()->back()->with('success', 'Enrolled successfully.');
    }
     public function addStudent(Request $request, Course $course)
    {
        $data = $request->validate([
            'student_name' => 'required|string|max:255',
            'student_email' => 'required|email',
            'student_password' => 'required|string|min:6',
        ]);

       
        $user = User::where('email', $data['student_email'])->first();

        if (!$user) {
            $user = User::create([
                'name' => $data['student_name'],
                'email' => $data['student_email'],
                'password' => Hash::make($data['student_password']),
                'role' => 'student',
            ]);
        }

     
        if ($course->students()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'Student already enrolled.');
        }

     
        if ($course->students()->count() >= $course->max_students) {
            return redirect()->back()->with('error', 'This course is full.');
        }

        
        $course->students()->attach($user->id);

        return redirect()->back()->with('success', 'Student added successfully.');
    }

    
    public function destroy(Course $course)
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login.');
        }

        Enrollment::where('user_id', $userId)
            ->where('course_id', $course->id)
            ->delete();

        return redirect()->back()->with('success', 'Unenrolled successfully.');
    }
    public function removeStudent(Course $course, User $user)
{

    if (!$course->students()->where('user_id', $user->id)->exists()) {
        return redirect()->back()->with('error', 'Student is not enrolled in this course.');
    }

    
    $course->students()->detach($user->id);

    return redirect()->back()->with('success', 'Student removed successfully.');
}

}
