@extends('layout')

@section('content')
<div class="card">
  <div class="card-header">Edit Teacher</div>
  <div class="card-body">
    <form action="{{ route('teachers.update', $teachers->id) }}" method="post">
      @csrf
      @method('PUT')

      <label>Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $teachers->name) }}">
      @error('name') <div class="text-danger">{{ $message }}</div> @enderror

      <label>Subject</label>
      <input type="text" name="subject" class="form-control" value="{{ old('subject', $teachers->subject) }}">
      @error('subject') <div class="text-danger">{{ $message }}</div> @enderror

      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $teachers->email) }}">
      @error('email') <div class="text-danger">{{ $message }}</div> @enderror

      <label>Mobile</label>
      <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $teachers->mobile) }}">
      @error('mobile') <div class="text-danger">{{ $message }}</div> @enderror

      <br>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Back</a>
    </form>
  </div>
</div>

@endsection
