@extends('layout')
@section('content')
<div class="card"><div class="card-header">Edit Course</div><div class="card-body">
<form action="{{ route('courses.update', $course->id) }}" method="post">@csrf @method('PUT')
<label>Title</label><input name="title" class="form-control" value="{{ old('title', $course->title) }}"><br>
<label>Description</label><textarea name="description" class="form-control">{{ old('description', $course->description) }}</textarea><br>
<button class="btn btn-primary">Update</button>
</form>
<a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
</div></div>
@endsection
