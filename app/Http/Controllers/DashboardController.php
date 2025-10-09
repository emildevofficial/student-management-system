<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index(): View
    {
        $students = Student::count();
        $teachers = Teacher::count();
        $courses = Course::count();
        $enrollments = Enrollment::count();
        $payments = Payment::count();

        return view('dashboard', compact('students','teachers','courses','enrollments','payments'));
    }
}
