@extends('layout')
@section('content')
<div class="card"><div class="card-header">Course Details</div><div class="card-body">
  <h4>{{ $course->title }}</h4>
  <p>{{ $course->description }}</p>
  <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary">Edit</a>
  <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
</div></div>
@endsection
