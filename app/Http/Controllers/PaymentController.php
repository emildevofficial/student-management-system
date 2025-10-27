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

    public function edit($id)
{
    $payment = Payment::findOrFail($id);
    $students = Student::all();
    return view('payments.edit', compact('payment', 'students'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'student_id' => 'required|exists:students,id',
        'amount' => 'required|numeric|min:0',
        'paid_at' => 'required|date',
    ]);

    $payment = Payment::findOrFail($id);
    $payment->update($validated);

    return redirect()->route('payments.index')->with('flash_message', 'Payment updated successfully.');
}

public function show(Payment $payment)
{
    return view('payments.show', compact('payment'));
}


public function destroy($id)
{
    $payment = Payment::findOrFail($id);
    $payment->delete();

    return redirect()
        ->route('payments.index')
        ->with('flash_message', 'Payment deleted successfully.');
}

        
}
