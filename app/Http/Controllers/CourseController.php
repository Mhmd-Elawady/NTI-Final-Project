<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CourseController extends Controller
{
    
    public function index() {
        $routeName = Route::currentRouteName();

        if ($routeName === 'home') {
            return view('index');
        }

       
        $courses = Course::all();
        return view('student_courses', compact('courses'));
    }

    
    public function dashboard() {
        $courses = Course::where('instructor_id', Auth::id())->get();
        return view('instructor_dashboard', compact('courses'));
    }

   
    public function allCourses() {
        $courses = Course::all();
        return view('student_courses', compact('courses'));
    }

    
    public function myCourses() {
        $user = Auth::user();
        $courses = $user->enrolledCourses; 
        return view('student_my_courses', compact('courses'));
    }

    
    public function create() {
        return view('create_course');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'max_students' => 'required|integer|min:1',
        ]);
        $data['instructor_id'] = Auth::id();
        Course::create($data);
        return redirect()->route('instructor.dashboard');
    }

  
    public function edit(Course $course) {
        if ($course->instructor_id !== Auth::id()) return redirect()->route('instructor.dashboard');
        return view('edit_course', compact('course'));
    }

    
    public function update(Request $request, Course $course) {
        if ($course->instructor_id !== Auth::id()) return redirect()->route('instructor.dashboard');
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'max_students' => 'required|integer|min:1',
        ]);
        $course->update($data);
        return redirect()->route('instructor.dashboard');
    }

    
    public function destroy(Course $course) {
        if ($course->instructor_id !== Auth::id()) return redirect()->route('instructor.dashboard');
        $course->delete();
        return redirect()->route('instructor.dashboard');
    }

    
    public function students(Course $course) {
        if ($course->instructor_id !== Auth::id()) return redirect()->route('instructor.dashboard');
        $students = $course->students; 
        return view('course_students', compact('course','students'));
    }
    
    
}
