<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

class EnrollmentController extends Controller
{
   public function index(): View
{
    $enrollments = Enrollment::with(['student','course'])->get();
    return view('enrollments.index')->with('enrollments', $enrollments);
}

public function create(): View
{
    $students = Student::all();
    $courses = Course::all();
    return view('enrollments.create')->with(['students'=>$students,'courses'=>$courses]);
}

public function store(Request $request)
{
    $request->validate([
        'student_name' => 'required|string',
        'course_title' => 'required|string',
        'enrolled_at' => 'nullable|date',
    ]);

    // Case-insensitive lookup
    $student = Student::whereRaw('LOWER(name) = ?', [strtolower($request->student_name)])->first();
    $course = Course::whereRaw('LOWER(title) = ?', [strtolower($request->course_title)])->first();

    // If not found, return with visible error message
    if (!$student || !$course) {
        return back()
            ->withErrors([
                'student_name' => $student ? null : 'Student not found. Please check the name.',
                'course_title' => $course ? null : 'Course not found. Please check the title.',
            ])
            ->withInput();
    }

    Enrollment::create([
        'student_id' => $student->id,
        'course_id' => $course->id,
        'enrolled_at' => $request->enrolled_at ?? now(),
    ]);

    return redirect()->route('enrollments.index')
        ->with('flash_message', 'Enrollment created successfully.');
}


public function edit(Enrollment $enrollment): View
{
    $students = Student::all();
    $courses = Course::all();
    return view('enrollments.edit')->with(['enrollment' => $enrollment, 'students' => $students, 'courses' => $courses]);
}

public function update(Request $request, Enrollment $enrollment)
{
    $request->validate([
        'student_name' => 'required|string',
        'course_title' => 'required|string',
        'enrolled_at' => 'required|date',
    ]);

    $student = Student::where('name', $request->student_name)->first();
    $course = Course::where('title', $request->course_title)->first();

    if (!$student || !$course) {
        return back()->withErrors([
            'student_name' => $student ? null : 'Student not found',
            'course_title' => $course ? null : 'Course not found',
        ])->withInput();
    }

    $enrollment->update([
        'student_id' => $student->id,
        'course_id' => $course->id,
        'enrolled_at' => $request->enrolled_at,
    ]);

    return redirect()->route('enrollments.index')->with('flash_message', 'Enrollment updated successfully.');
}


public function show(Enrollment $enrollment): View
{
    return view('enrollments.show')->with('enrollment', $enrollment);
}


public function destroy(Enrollment $enrollment): RedirectResponse
{
    $enrollment->delete();
    return redirect()->route('enrollments.index')->with('flash_message', 'Enrollment deleted.');
}

}
