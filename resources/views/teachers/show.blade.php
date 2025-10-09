@extends('layout')

@section('content')
<div class="card">
  <div class="card-header">Teacher Details</div>
  <div class="card-body">
    <h4>{{ $teachers->name }}</h4>
    <p><strong>Subject:</strong> {{ $teachers->subject }}</p>
    <p><strong>Email:</strong> {{ $teachers->email }}</p>
    <p><strong>Mobile:</strong> {{ $teachers->mobile }}</p>

    <a href="{{ route('teachers.edit', $teachers->id) }}" class="btn btn-primary">Edit</a>

    <form action="{{ route('teachers.destroy', $teachers->id) }}" method="POST" style="display:inline">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>

    <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Back to list</a>
  </div>
</div>

@endsection
