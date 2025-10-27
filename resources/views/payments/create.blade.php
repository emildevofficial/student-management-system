@extends('layouts.layout')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4">
    <div class="max-w-2xl mx-auto"> <!-- Changed from max-w-lg to max-w-2xl for wider layout -->
        <!-- Header Card -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-6 transform hover:scale-[1.01] transition-all duration-300">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fa fa-credit-card text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Record New Payment</h2>
                            <p class="text-blue-100 text-sm">Add a payment transaction to the system</p>
                        </div>
                    </div>
                    <a href="{{ route('payments.index') }}" class="text-white/80 hover:text-white transition-colors">
                        <i class="fa fa-times text-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                <form action="{{ route('payments.store') }}" method="post" id="paymentForm">
                    @csrf

                    <!-- Error Display -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg animate-pulse">
                            <div class="flex items-center mb-2">
                                <i class="fa fa-exclamation-triangle text-red-500 mr-2"></i>
                                <h3 class="text-red-800 font-semibold">Please fix the following errors:</h3>
                            </div>
                            <ul class="text-red-700 text-sm list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Student Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fa fa-user-graduate mr-2 text-blue-500"></i>
                            Student Information
                        </label>
                        <div class="relative">
                            <select 
                                name="student_id" 
                                class="w-full border-2 border-gray-200 rounded-xl p-4 pl-12 pr-10 text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 appearance-none bg-white cursor-pointer"
                                required
                                id="studentSelect"
                            >
                                <option value="" class="text-gray-400">-- Select a student --</option>
                                @foreach($students as $s)
                                    <option value="{{ $s->id }}" {{ old('student_id') == $s->id ? 'selected' : '' }}>
                                        {{ $s->name }} 
                                        @if($s->email) - {{ $s->email }} @endif
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fa fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Amount Input -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fa fa-money-bill-wave mr-2 text-green-500"></i>
                            Payment Amount
                        </label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fa fa-dollar-sign"></i>
                            </div>
                            <input 
                                name="amount" 
                                type="number" 
                                step="0.01" 
                                min="0"
                                placeholder="0.00"
                                value="{{ old('amount') }}"
                                class="w-full border-2 border-gray-200 rounded-xl p-4 pl-12 pr-10 text-lg font-semibold text-gray-800 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200"
                                id="amountInput"
                            >
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">
                                USD
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-500 flex justify-between">
                            <span>Enter the payment amount</span>
                            <span id="amountPreview" class="font-semibold text-green-600"></span>
                        </div>
                    </div>

                    <!-- Payment Date -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fa fa-calendar-alt mr-2 text-purple-500"></i>
                            Payment Date
                        </label>
                        <div class="relative">
                            <input 
                                type="date" 
                                name="paid_at" 
                                value="{{ old('paid_at', date('Y-m-d')) }}"
                                class="w-full border-2 border-gray-200 rounded-xl p-4 pl-12 text-gray-700 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200"
                            >
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fa fa-credit-card mr-2 text-orange-500"></i>
                            Payment Method
                        </label>
                        <div class="grid grid-cols-3 gap-3">
                            <div class="relative">
                                <input type="radio" name="payment_method" value="cash" id="cash" class="hidden peer" checked>
                                <label for="cash" class="flex flex-col items-center p-3 border-2 border-gray-200 rounded-xl cursor-pointer peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all duration-200">
                                    <i class="fa fa-money-bill text-gray-600 text-xl mb-1"></i>
                                    <span class="text-sm font-medium">Cash</span>
                                </label>
                            </div>
                            <div class="relative">
                                <input type="radio" name="payment_method" value="card" id="card" class="hidden peer">
                                <label for="card" class="flex flex-col items-center p-3 border-2 border-gray-200 rounded-xl cursor-pointer peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all duration-200">
                                    <i class="fa fa-credit-card text-gray-600 text-xl mb-1"></i>
                                    <span class="text-sm font-medium">Card</span>
                                </label>
                            </div>
                            <div class="relative">
                                <input type="radio" name="payment_method" value="transfer" id="transfer" class="hidden peer">
                                <label for="transfer" class="flex flex-col items-center p-3 border-2 border-gray-200 rounded-xl cursor-pointer peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all duration-200">
                                    <i class="fa fa-university text-gray-600 text-xl mb-1"></i>
                                    <span class="text-sm font-medium">Transfer</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                        <a 
                            href="{{ route('payments.index') }}" 
                            class="flex items-center px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-200 transform hover:scale-105"
                        >
                            <i class="fa fa-arrow-left mr-2"></i>
                            Back to Payments
                        </a>
                        <button 
                            type="submit" 
                            class="flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200"
                            id="submitButton"
                        >
                            <i class="fa fa-check-circle mr-2"></i>
                            Save Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Quick Tips - Removed as requested -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('amountInput');
        const amountPreview = document.getElementById('amountPreview');
        const studentSelect = document.getElementById('studentSelect');
        const submitButton = document.getElementById('submitButton');
        const form = document.getElementById('paymentForm');

        // Format amount as user types
        amountInput.addEventListener('input', function() {
            const value = parseFloat(amountInput.value) || 0;
            amountPreview.textContent = `$${value.toFixed(2)}`;
        });

        // Add loading state to form submission
        form.addEventListener('submit', function() {
            submitButton.innerHTML = '<i class="fa fa-spinner fa-spin mr-2"></i> Processing...';
            submitButton.disabled = true;
        });

        // Initialize amount preview
        if (amountInput.value) {
            const value = parseFloat(amountInput.value) || 0;
            amountPreview.textContent = `$${value.toFixed(2)}`;
        }
    });
</script>

<style>
    select:focus, input:focus {
        outline: none;
    }
    
    /* Custom scrollbar for select */
    select {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e0 #f7fafc;
    }
    
    select::-webkit-scrollbar {
        width: 6px;
    }
    
    select::-webkit-scrollbar-track {
        background: #f7fafc;
        border-radius: 3px;
    }
    
    select::-webkit-scrollbar-thumb {
        background-color: #cbd5e0;
        border-radius: 3px;
    }
</style>
@endsection