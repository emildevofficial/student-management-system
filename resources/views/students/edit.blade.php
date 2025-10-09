@extends('layout')

@section('content')
<div class="card">
  <div class="card-header">Edit Student</div>
  <div class="card-body">
    <form action="{{ route('students.update', $students->id) }}" method="post">
      @csrf
      @method('PUT')

      <label>Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $students->name) }}">
      @error('name') <div class="text-danger">{{ $message }}</div> @enderror

      <label>Address</label>
      <input type="text" name="address" class="form-control" value="{{ old('address', $students->address) }}">
      @error('address') <div class="text-danger">{{ $message }}</div> @enderror

      <label>Mobile</label>
      <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $students->mobile) }}">
      @error('mobile') <div class="text-danger">{{ $message }}</div> @enderror

      <br>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
    </form>
  </div>
</div>

@endsection
