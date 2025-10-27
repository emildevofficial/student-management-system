<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Event;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Summary counts
        $students = Student::count();
        $teachers = Teacher::count();
        $courses = Course::count();
        $enrollments = Enrollment::count();
        $payments = Payment::sum('amount');

        // Last 6 months
        $months = [];
        $enrollmentData = [];
        $revenueData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');

            $enrollmentData[] = Enrollment::whereMonth('created_at', $date->month)
                                          ->whereYear('created_at', $date->year)
                                          ->count();

            $revenueData[] = Payment::whereMonth('created_at', $date->month)
                                    ->whereYear('created_at', $date->year)
                                    ->sum('amount');
        }

        // Generate colors for revenue bars
        $revenueColors = array_map(function($val) {
            return $val > 1000 ? 'rgba(239,68,68,0.8)' : 'rgba(239,68,68,0.5)';
        }, $revenueData);

        // Latest 5 payments
        $recentPayments = Payment::with('student')->latest()->take(5)->get();

        // Latest 5 upcoming events
        $events = Event::where('start_date', '>=', now())
                      ->orderBy('start_date', 'asc')
                      ->take(5)
                      ->get();

        return view('dashboard', compact(
            'students','teachers','courses','enrollments','payments',
            'months','enrollmentData','revenueData','recentPayments','revenueColors','events'
        ));
        
    }
}