<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AuthController;

// ----------------------
// Public Landing Page
// ----------------------
Route::get('/', function() {
    return view('index'); // simple landing page
})->name('home');

// ----------------------
// Authentication
// ----------------------
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ----------------------
// Student Routes
// ----------------------
Route::middleware(['auth','student'])->group(function() {
    // Student dashboard: all available courses
    Route::get('/student_courses', [CourseController::class, 'index'])->name('student.courses');

    // Courses the student is enrolled in
    Route::get('/student_my_courses', [CourseController::class, 'myCourses'])->name('student.mycourses');

    // Enroll/unenroll
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::delete('/courses/{course}/unenroll', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
});
// ----------------------
// Instructor Routes
// ----------------------
Route::middleware(['auth','instructor'])->group(function() {
    // Instructor dashboard
    Route::get('/instructor_dashboard', [CourseController::class, 'dashboard'])->name('instructor.dashboard');

    // Course management
    Route::get('/create_course', [CourseController::class, 'create'])->name('courses.create.view');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/edit_course/{course}', [CourseController::class, 'edit'])->name('courses.edit.view');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    Route::get('/course_students/{course}', [CourseController::class, 'students'])->name('course.students');

    //  Add student 
    Route::post('/courses/{course}/add-student', [EnrollmentController::class, 'addStudent'])->name('enrollments.addStudent');
    // Remove a student from a course
Route::delete('/courses/{course}/enrollments/{user}', [EnrollmentController::class, 'removeStudent'])->name('enrollments.removeStudent');

});

