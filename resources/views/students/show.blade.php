@extends('layout')

@section('content')
<div class="card">
  <div class="card-header">Student Details</div>
  <div class="card-body">
    <h4>{{ $students->name }}</h4>
    <p><strong>Address:</strong> {{ $students->address }}</p>
    <p><strong>Mobile:</strong> {{ $students->mobile }}</p>

    <a href="{{ route('students.edit', $students->id) }}" class="btn btn-primary">Edit</a>

    <form action="{{ route('students.destroy', $students->id) }}" method="POST" style="display:inline">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>

    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to list</a>
  </div>
</div>

@endsection
