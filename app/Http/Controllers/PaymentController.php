<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Payment;
use App\Models\Student;

class PaymentController extends Controller
{
    public function index(): View
    {
        $payments = Payment::with('student')->get();
        return view('payments.index')->with('payments', $payments);
    }

    public function create(): View
    {
        $students = Student::all();
        return view('payments.create')->with('students', $students);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric',
        ]);

        $validated['paid_at'] = now();
        Payment::create($validated);

        return redirect()->route('payments.index')->with('flash_message', 'Payment recorded.');
    }
}
