@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8 px-6">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-2">
                <h1 class="text-3xl font-bold text-gray-800">Add New Teacher</h1>
                <a 
                    href="{{ route('teachers.index') }}" 
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200"
                >
                    <i class="fa fa-arrow-left mr-2"></i> Back to Teachers
                </a>
            </div>
            <p class="text-gray-600">Add a new teacher to the teaching staff</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Card Header -->
            <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fa fa-user-plus text-blue-500 mr-2"></i> Teacher Information
                </h2>
            </div>

            <!-- Form -->
            <form action="{{ route('teachers.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name"
                        value="{{ old('name') }}"
                        placeholder="Enter teacher's full name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        required
                    >
                    @error('name')
                        <div class="flex items-center mt-2 text-sm text-red-600">
                            <i class="fa fa-exclamation-circle mr-1.5"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Subject Field -->
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                        Subject
                    </label>
                    <input 
                        type="text" 
                        name="subject" 
                        id="subject"
                        value="{{ old('subject') }}"
                        placeholder="Enter subject taught"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('subject') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
                    @error('subject')
                        <div class="flex items-center mt-2 text-sm text-red-600">
                            <i class="fa fa-exclamation-circle mr-1.5"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        value="{{ old('email') }}"
                        placeholder="Enter email address"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
                    @error('email')
                        <div class="flex items-center mt-2 text-sm text-red-600">
                            <i class="fa fa-exclamation-circle mr-1.5"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Mobile Field -->
                <div>
                    <label for="mobile" class="block text-sm font-medium text-gray-700 mb-2">
                        Mobile Number
                    </label>
                    <input 
                        type="text" 
                        name="mobile" 
                        id="mobile"
                        value="{{ old('mobile') }}"
                        placeholder="Enter mobile number"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('mobile') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
                    @error('mobile')
                        <div class="flex items-center mt-2 text-sm text-red-600">
                            <i class="fa fa-exclamation-circle mr-1.5"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                    <a 
                        href="{{ route('teachers.index') }}" 
                        class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200 order-2 sm:order-1"
                    >
                        <i class="fa fa-times mr-2"></i> Cancel
                    </a>
                    <button 
                        type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 shadow-sm transition-colors duration-200 order-1 sm:order-2"
                    >
                        <i class="fa fa-save mr-2"></i> Save Teacher
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
        console.log('Teacher created successfully');
    });
</script>
@endif
@endsection