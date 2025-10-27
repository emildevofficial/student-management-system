@extends('layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 text-white px-6 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Enrollment Details</h1>
            <a href="{{ route('enrollments.index') }}" class="px-3 py-1 bg-white text-blue-600 font-medium rounded hover:bg-gray-100">
                
            </a>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-4">
            <div class="flex items-center justify-between border-b pb-3">
                <span class="text-gray-600 font-medium">Student</span>
                <span class="text-gray-800 font-semibold">{{ $enrollment->student->name ?? 'N/A' }}</span>
            </div>

            <div class="flex items-center justify-between border-b pb-3">
                <span class="text-gray-600 font-medium">Course</span>
                <span class="text-gray-800 font-semibold">{{ $enrollment->course->title ?? 'N/A' }}</span>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-gray-600 font-medium">Enrolled At</span>
                <span class="text-gray-800 font-semibold">{{ $enrollment->enrolled_at }}</span>
            </div>
        </div>

        <!-- Footer / Actions -->
        <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-2">
            <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Edit
            </a>
            <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enrollment?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

