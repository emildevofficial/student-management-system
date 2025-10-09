@extends('layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
  <div class="card">
    <div class="text-sm text-gray-500">Students</div>
    <div class="text-2xl font-bold">{{ $students }}</div>
  </div>
  <div class="card">
    <div class="text-sm text-gray-500">Teachers</div>
    <div class="text-2xl font-bold">{{ $teachers }}</div>
  </div>
  <div class="card">
    <div class="text-sm text-gray-500">Courses</div>
    <div class="text-2xl font-bold">{{ $courses }}</div>
  </div>
  <div class="card">
    <div class="text-sm text-gray-500">Enrollments</div>
    <div class="text-2xl font-bold">{{ $enrollments }}</div>
  </div>
  <div class="card">
    <div class="text-sm text-gray-500">Payments</div>
    <div class="text-2xl font-bold">{{ $payments }}</div>
  </div>
</div>
@endsection
