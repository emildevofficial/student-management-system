@extends('layout')

@section('content')
<div class="card">
  <div class="card-header">Add Teacher</div>
  <div class="card-body">

    <form action="{{ route('teachers.store') }}" method="post">
        @csrf
        <label>Name</label><br>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        <br>
        <label>Subject</label><br>
        <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}">
        @error('subject') <div class="text-danger">{{ $message }}</div> @enderror
        <br>
        <label>Email</label><br>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        <br>
        <label>Mobile</label><br>
        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}">
        @error('mobile') <div class="text-danger">{{ $message }}</div> @enderror
        <br>
        <input type="submit" value="Save" class="btn btn-success"><br>
    </form>

  </div>
</div>

@endsection
