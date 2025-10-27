@extends('layouts.layout')
@section('content')

<div class="min-h-screen bg-gray-50 py-8 px-6">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-2">
                <h1 class="text-2xl font-bold text-gray-900">Edit Enrollment</h1>
                <a 
                    href="{{ route('enrollments.index') }}" 
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                >
                    <i class="fa fa-arrow-left mr-2"></i> Back to Enrollments
                </a>
            </div>
            <p class="text-gray-600">Update student course registration</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <!-- Card Header -->
            <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fa fa-edit text-blue-500 mr-2"></i> Edit Enrollment Information
                </h2>
            </div>

            <!-- Form -->
            <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Student Selection -->
                <div>
                    <label for="student_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Student <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="student_id" 
                        id="student_id"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('student_id') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        required
                    >
                        <option value="">Select a student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id', $enrollment->student_id) == $student->id ? 'selected' : '' }}>
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

                <!-- Course Selection -->
                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Course <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="course_id" 
                        id="course_id"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('course_id') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        required
                    >
                        <option value="">Select a course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id', $enrollment->course_id) == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="flex items-center mt-2 text-sm text-red-600">
                            <i class="fa fa-exclamation-circle mr-1.5"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Enrollment Date -->
                <div>
                    <label for="enrolled_at" class="block text-sm font-medium text-gray-700 mb-2">
                        Enrollment Date <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        name="enrolled_at" 
                        id="enrolled_at"
                        value="{{ old('enrolled_at', $enrollment->enrolled_at) }}"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('enrolled_at') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        required
                    >
                    @error('enrolled_at')
                        <div class="flex items-center mt-2 text-sm text-red-600">
                            <i class="fa fa-exclamation-circle mr-1.5"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Enrollment Info -->
                <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                    <h4 class="text-sm font-semibold text-blue-800 mb-2">Enrollment Details</h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600">Created:</span>
                            <span class="font-medium text-gray-800 ml-1">{{ $enrollment->created_at->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Last Updated:</span>
                            <span class="font-medium text-gray-800 ml-1">{{ $enrollment->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                    <a 
                        href="{{ route('enrollments.index') }}" 
                        class="inline-flex items-center justify-center px-6 py-2.5 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors order-2 sm:order-1"
                    >
                        <i class="fa fa-times mr-2"></i> Cancel
                    </a>
                    <button 
                        type="submit"
                        class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors order-1 sm:order-2"
                    >
                        <i class="fa fa-save mr-2"></i> Update Enrollment
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Update the enrollment information as needed
            </p>
        </div>
    </div>
</div>

@endsection