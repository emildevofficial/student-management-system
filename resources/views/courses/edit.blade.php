@extends('layouts.layout')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50/30 py-8 px-6">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-2">
                <h1 class="text-3xl font-bold text-gray-800">Edit Course</h1>
                <a 
                    href="{{ route('courses.index') }}" 
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200"
                >
                    <i class="fa fa-arrow-left mr-2"></i> Back to Courses
                </a>
            </div>
            <p class="text-gray-600">Update and refine your course content</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Card Header -->
            <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center mr-3">
                        <i class="fa fa-edit text-white"></i>
                    </div>
                    Edit Course Information
                </h2>
            </div>

            <!-- Form -->
            <form action="{{ route('courses.update', $course->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Title Field -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Course Title <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title"
                        value="{{ old('title', $course->title) }}"
                        placeholder="Enter an engaging course title"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors duration-200 @error('title') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        required
                    >
                    @error('title')
                        <div class="flex items-center mt-2 text-sm text-red-600">
                            <i class="fa fa-exclamation-circle mr-1.5"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Description Field -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Course Description
                    </label>
                    <textarea 
                        name="description" 
                        id="description"
                        rows="6"
                        placeholder="Describe what students will learn, course objectives, and key takeaways..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors duration-200 @error('description') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    >{{ old('description', $course->description) }}</textarea>
                    @error('description')
                        <div class="flex items-center mt-2 text-sm text-red-600">
                            <i class="fa fa-exclamation-circle mr-1.5"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    <p class="text-xs text-gray-500 mt-2">Keep your description updated and engaging for students</p>
                </div>

                <!-- Course Stats -->
                <div class="bg-blue-50 rounded-2xl p-4 border border-blue-100">
                    <h4 class="text-sm font-semibold text-blue-800 mb-2">Course Information</h4>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600">Created:</span>
                            <span class="font-medium text-gray-800 ml-1">{{ $course->created_at->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Last Updated:</span>
                            <span class="font-medium text-gray-800 ml-1">{{ $course->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                    <a 
                        href="{{ route('courses.index') }}" 
                        class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors duration-200 order-2 sm:order-1"
                    >
                        <i class="fa fa-times mr-2"></i> Cancel
                    </a>
                    <button 
                        type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-amber-600 to-orange-600 text-white font-medium rounded-xl hover:from-amber-700 hover:to-orange-700 shadow-sm transition-all duration-200 order-1 sm:order-2 group"
                    >
                        <i class="fa fa-save mr-2 group-hover:scale-110 transition-transform"></i> Update Course
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Make your course stand out with clear and compelling content
            </p>
        </div>
    </div>
</div>

@endsection