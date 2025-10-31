<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // === Summary counts ===
        $students     = Student::count();
        $teachers     = Teacher::count();
        $courses      = Course::count();
        $enrollments  = Enrollment::count();
        $payments     = Payment::sum('amount');

        // === Last 6 months (ending current month) ===
        $months = [];
        $enrollmentData = [];
        $revenueData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $label = $date->format('M Y'); // e.g. Oct 2025
            $months[] = $label;

            // Enrollment count
            $enrollmentData[] = Enrollment::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();

            // Payment sum
            $revenueData[] = Payment::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('amount');
        }

        // === Dynamic bar colors ===
        $revenueColors = collect($revenueData)->map(fn($val) =>
            $val > 0 ? '#fbbf24' : 'rgba(200,200,200,0.3)'
        );

        // === Recent payments & upcoming events ===
        $recentPayments = Payment::with('student')->latest()->take(5)->get();

        $events = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(5)
            ->get();

        // === Return view ===
        return view('dashboard', [
            'students'       => $students,
            'teachers'       => $teachers,
            'courses'        => $courses,
            'enrollments'    => $enrollments,
            'payments'       => $payments,
            'months'         => $months,
            'enrollmentData' => $enrollmentData,
            'revenueData'    => $revenueData,
            'revenueColors'  => $revenueColors,
            'recentPayments' => $recentPayments,
            'events'         => $events,
        ]);
    }
}
