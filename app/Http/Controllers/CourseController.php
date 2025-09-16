<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // 🏠 عرض كل الكورسات (للكل)
    public function index()
    {
        $courses = Course::all();
        return view('index', compact('courses'));
    }

    // 🎓 عرض كورسات الطالب المسجّل فيها
    public function myCourses()
    {
        $user = Auth::user();
        $courses = $user->courses; // العلاقة من User
        return view('student_my_courses', compact('courses'));
    }

    // 👨‍🏫 صفحة إنشاء كورس جديد
    public function create()
    {
        return view('create_course');
    }

    // 👨‍🏫 حفظ كورس جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'start_date'   => 'required|date',
            'max_students' => 'required|integer|min:1',
        ]);

        $data['instructor_id'] = Auth::id();
        Course::create($data);

        return redirect()->route('instructor_dashboard')
                         ->with('success', 'تم إنشاء الكورس بنجاح ✅');
    }

    // 👨‍🏫 صفحة تعديل كورس
    public function edit(Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            return redirect()->route('instructor_dashboard')
                             ->with('error', 'غير مسموح لك بتعديل هذا الكورس ❌');
        }

        return view('edit_course', compact('course'));
    }

    // 👨‍🏫 تحديث بيانات الكورس
    public function update(Request $request, Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            return redirect()->route('instructor_dashboard')
                             ->with('error', 'غير مسموح لك بتحديث هذا الكورس ❌');
        }

        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'start_date'   => 'required|date',
            'max_students' => 'required|integer|min:1',
        ]);

        $course->update($data);

        return redirect()->route('instructor_dashboard')
                         ->with('success', 'تم تعديل الكورس بنجاح ✅');
    }

    // 👨‍🏫 حذف كورس
    public function destroy(Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            return redirect()->route('instructor_dashboard')
                             ->with('error', 'غير مسموح لك بحذف هذا الكورس ❌');
        }

        $course->delete();

        return redirect()->route('instructor_dashboard')
                         ->with('success', 'تم حذف الكورس بنجاح ✅');
    }

    // 👨‍🏫 عرض الطلاب المسجّلين في كورس
    public function students(Course $course)
    {
        if ($course->instructor_id !== Auth::id()) {
            return redirect()->route('instructor_dashboard')
                             ->with('error', 'غير مسموح لك بعرض هذا الكورس ❌');
        }

        $students = $course->students; // العلاقة من Course
        return view('student_courses', compact('course', 'students'));
    }
}