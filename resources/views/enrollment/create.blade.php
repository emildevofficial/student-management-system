@extends('layout')
@section('content')

<div class="max-w-md bg-white p-6 rounded shadow">
	<h2 class="text-lg font-semibold mb-4">New Enrollment</h2>

	<form action="{{ route('enrollment.store') }}" method="post">@csrf

		@if ($errors->any())
			<div class="mb-3 p-3 bg-red-50 border border-red-200 text-red-700 rounded">
				<ul class="mb-0">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<label class="block text-sm">Student</label>
		<select name="student_id" class="w-full border rounded p-2 mb-3" required>
			<option value="">-- choose student --</option>
			@foreach($students as $s)
				<option value="{{ $s->id }}" {{ old('student_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
			@endforeach
		</select>

		<label class="block text-sm">Course</label>
		<select name="course_id" class="w-full border rounded p-2 mb-4" required>
			<option value="">-- choose course --</option>
			@foreach($courses as $c)
				<option value="{{ $c->id }}" {{ old('course_id') == $c->id ? 'selected' : '' }}>{{ $c->title }}</option>
			@endforeach
		</select>

		<div class="flex justify-end">
			<a href="{{ route('enrollment.index') }}" class="mr-2 px-4 py-2">Cancel</a>
			<button type="submit" class="px-4 py-2 bg-white text-blue-600 border border-blue-100 rounded hover:bg-blue-50">Enroll</button>
		</div>

	</form>
</div>

@endsection
