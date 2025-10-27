@extends('layouts.layout')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4">
    <div class="max-w-md mx-auto">
        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-receipt text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Payment Details</h2>
                            <p class="text-blue-100 text-sm">Transaction Information</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Student -->
                    <div class="flex items-center p-4 bg-blue-50 rounded-xl border border-blue-100">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fa-solid fa-user-graduate text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Student</p>
                            <p class="text-gray-800 font-semibold">{{ $payment->student->name }}</p>
                        </div>
                    </div>

                    <!-- Amount -->
                    <div class="flex items-center p-4 bg-green-50 rounded-xl border border-green-100">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fa-solid fa-dollar-sign text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Amount</p>
                            <p class="text-green-600 font-bold text-lg">${{ number_format($payment->amount, 2) }}</p>
                        </div>
                    </div>

                    <!-- Payment Date -->
                    <div class="flex items-center p-4 bg-purple-50 rounded-xl border border-purple-100">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fa-solid fa-calendar-day text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Paid At</p>
                            <p class="text-gray-800 font-semibold">{{ $payment->paid_at->format('M j, Y - g:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-6 mt-6 border-t border-gray-200">
                    <a href="{{ route('payments.index') }}" 
                       class="flex items-center px-5 py-2.5 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-200 transform hover:scale-105">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        Back
                    </a>
                    <a href="{{ route('payments.edit', $payment->id) }}" 
                       class="flex items-center px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                        <i class="fa-solid fa-pen mr-2"></i>
                        Edit Payment
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection