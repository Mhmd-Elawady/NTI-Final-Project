<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AuthController;

// ======================
// 🏠 Home Page
// ======================
Route::get('/', [CourseController::class, 'index'])->name('home');

// ======================
// 🔑 Authentication
// ======================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ======================
// 🎓 Student Routes
// ======================
Route::middleware(['auth', 'student'])->group(function () {
    // تسجيل الكورس
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::delete('/courses/{course}/unenroll', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');

    // صفحات الطالب
    Route::get('/student_courses', function () { 
        return view('student_courses'); 
    })->name('student.courses');

    Route::get('/student_my_courses', function () { 
        return view('student_my_courses'); 
    })->name('student.mycourses');
});

// ======================
// 👨‍🏫 Instructor Routes
// ======================
Route::middleware(['auth', 'instructor'])->group(function () {
    // إدارة الكورسات
    Route::get('/create_course', [CourseController::class, 'create'])->name('courses.create.view');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/edit_course/{course}', [CourseController::class, 'edit'])->name('courses.edit.view');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
     Route::get('/course_students/{course}', [CourseController::class, 'students'])->name('course.students');


    // صفحات المدرّب
    Route::get('/instructor_dashboard', function () { 
        return view('instructor_dashboard'); 
    })->name('instructor.dashboard');

    Route::get('/course_students', function () { 
        return view('course_students'); 
    })->name('course.students');
});

// ======================
// 🌍 Public Courses (anyone can see)
// ======================
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
