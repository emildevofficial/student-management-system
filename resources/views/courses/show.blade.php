@extends('layouts.layout')
@section('content')
<div class="max-w-3xl mx-auto">
  <div class="bg-white rounded shadow overflow-hidden">
    <div class="px-4 py-3 bg-blue-600">
      <h2 class="text-white font-bold">Course Details</h2>
    </div>
    <div class="p-6">
      <h3 class="text-lg font-semibold text-gray-900">{{ $course->title }}</h3>
      <p class="mt-3 text-gray-700">{{ $course->description }}</p>

      <div class="mt-6 space-x-3">
        <a href="{{ route('courses.edit', $course->id) }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
        <a href="{{ route('courses.index') }}" class="inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Back</a>
      </div>
    </div>
  </div>
</div>
@endsection
