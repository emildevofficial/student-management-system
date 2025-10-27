@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/30 py-8 px-6">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-2">
                <h1 class="text-3xl font-bold text-gray-800">Edit Payment</h1>
                <a 
                    href="{{ route('payments.index') }}" 
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200"
                >
                    <i class="fa fa-arrow-left mr-2"></i> Back to Payments
                </a>
            </div>
            <p class="text-gray-600">Update payment information and transaction details</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Card Header -->
            <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center mr-3">
                        <i class="fa fa-edit text-white"></i>
                    </div>
                    Edit Payment Information
                </h2>
            </div>

            <!-- Form -->
            <form action="{{ route('payments.update', $payment->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Error Message -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl">
                        <div class="flex items-center mb-2">
                            <i class="fa fa-exclamation-triangle text-red-500 mr-2"></i>
                            <h3 class="text-red-800 font-semibold">Please fix the following errors:</h3>
                        </div>
                        <ul class="text-red-700 text-sm list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Student Selection -->
                <div>
                    <label for="student_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Student <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="student_id" 
                        id="student_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors duration-200 @error('student_id') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        required
                    >
                        <option value="">Select a student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $payment->student_id) == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <div class="flex items-center mt-2 text-sm text-red-600">
                            <i class="fa fa-exclamation-circle mr-1.5"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Amount -->
                <div>
                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
                        Amount ($) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-bold">$</span>
                        </div>
                        <input 
                            type="number" 
                            step="0.01" 
                            name="amount" 
                            id="amount" 
                            value="{{ old('amount', $payment->amount) }}"
                            placeholder="0.00"
                            class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors duration-200 @error('amount') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                            required
                        >
                    </div>
                    @error('amount')
                        <div class="flex items-center mt-2 text-sm text-red-600">
                            <i class="fa fa-exclamation-circle mr-1.5"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Payment Date -->
                <div>
                    <label for="paid_at" class="block text-sm font-semibold text-gray-700 mb-2">
                        Payment Date & Time <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="datetime-local" 
                        name="paid_at" 
                        id="paid_at" 
                        value="{{ old('paid_at', \Carbon\Carbon::parse($payment->paid_at)->format('Y-m-d\TH:i')) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors duration-200 @error('paid_at') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        required
                    >
                    @error('paid_at')
                        <div class="flex items-center mt-2 text-sm text-red-600">
                            <i class="fa fa-exclamation-circle mr-1.5"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Payment Details Card -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-5 border border-blue-200">
                    <h4 class="text-sm font-semibold text-blue-800 uppercase tracking-wide mb-3">Payment Summary</h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-blue-600">Original Amount:</span>
                            <span class="font-bold text-blue-800 ml-1">${{ number_format($payment->amount, 2) }}</span>
                        </div>
                        <div>
                            <span class="text-blue-600">Payment Date:</span>
                            <span class="font-bold text-blue-800 ml-1">{{ \Carbon\Carbon::parse($payment->paid_at)->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <span class="text-blue-600">Created:</span>
                            <span class="font-bold text-blue-800 ml-1">{{ $payment->created_at->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <span class="text-blue-600">Last Updated:</span>
                            <span class="font-bold text-blue-800 ml-1">{{ $payment->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                    <a 
                        href="{{ route('payments.index') }}" 
                        class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors duration-200 order-2 sm:order-1"
                    >
                        <i class="fa fa-times mr-2"></i> Cancel
                    </a>
                    <button 
                        type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-amber-600 to-orange-600 text-white font-medium rounded-xl hover:from-amber-700 hover:to-orange-700 shadow-sm transition-all duration-200 order-1 sm:order-2 group"
                    >
                        <i class="fa fa-save mr-2 group-hover:scale-110 transition-transform"></i> Update Payment
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Fields marked with <span class="text-red-500">*</span> are required
            </p>
        </div>
    </div>
</div>

<!-- Success Message Script (if needed) -->
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // You can add toast notification here if needed
        console.log('Payment updated successfully');
    });
</script>
@endif

@endsection