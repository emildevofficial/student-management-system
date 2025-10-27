@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8 px-6">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-2">
                <h1 class="text-3xl font-bold text-gray-800">Student Details</h1>
                <a 
                    href="{{ route('students.index') }}" 
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200"
                >
                    <i class="fa fa-arrow-left mr-2"></i> Back to Students
                </a>
            </div>
            <p class="text-gray-600">View student information and manage profile</p>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Card Header -->
            <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fa fa-user-circle text-blue-500 mr-2"></i> Student Profile
                </h2>
            </div>

            <!-- Profile Content -->
            <div class="p-6">
                <!-- Avatar and Basic Info -->
                <div class="flex flex-col items-center text-center mb-8">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-lg mb-4">
                        {{ strtoupper(substr($students->name, 0, 1)) }}
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $students->name }}</h3>
                    <p class="text-gray-500 text-sm">Student ID: #{{ $students->id }}</p>
                </div>

                <!-- Details Grid -->
                <div class="grid gap-6 mb-8">
                    <!-- Address Section -->
                    <div class="bg-blue-50 rounded-lg p-5 border border-blue-100">
                        <div class="flex items-start">
                            <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                <i class="fa fa-map-marker-alt text-blue-600 text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-blue-800 uppercase tracking-wide mb-1">Address</h4>
                                <p class="text-gray-800 font-medium">{{ $students->address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div class="bg-green-50 rounded-lg p-5 border border-green-100">
                        <div class="flex items-start">
                            <div class="bg-green-100 p-3 rounded-lg mr-4">
                                <i class="fa fa-phone-alt text-green-600 text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-green-800 uppercase tracking-wide mb-1">Mobile Number</h4>
                                <p class="text-gray-800 font-medium text-lg">{{ $students->mobile }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                    <a 
                        href="{{ route('students.edit', $students->id) }}" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-amber-600 text-white font-medium rounded-lg hover:bg-amber-700 shadow-sm transition-colors duration-200 order-2 sm:order-1"
                    >
                        <i class="fa fa-edit mr-2"></i> Edit Student
                    </a>
                    <form 
                        action="{{ route('students.destroy', $students->id) }}" 
                        method="POST" 
                        class="inline order-1 sm:order-2"
                        onsubmit="return confirm('Are you sure you want to delete this student? This action cannot be undone.')"
                    >
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 shadow-sm transition-colors duration-200"
                        >
                            <i class="fa fa-trash mr-2"></i> Delete Student
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Student created on {{ $students->created_at->format('M d, Y') }}
            </p>
        </div>
    </div>
</div>

<!-- Delete Confirmation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // You can add custom delete confirmation logic here if needed
    const deleteForm = document.querySelector('form[action*="destroy"]');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this student? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    }
});
</script>
@endsection