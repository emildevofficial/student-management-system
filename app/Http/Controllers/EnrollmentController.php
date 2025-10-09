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
        return view('enrollment.index')->with('enrollments', $enrollments);
    }

    public function create(): View
    {
        $students = Student::all();
        $courses = Course::all();
        return view('enrollment.create')->with(['students'=>$students,'courses'=>$courses]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $validated['enrolled_at'] = now();
        Enrollment::create($validated);

        return redirect()->route('enrollment.index')->with('flash_message', 'Enrollment created.');
    }
}
