@extends('layout')
@section('content')

<div class="max-w-md bg-white p-6 rounded shadow">
	<h2 class="text-lg font-semibold mb-4">Add Course</h2>

	<form action="{{ route('courses.store') }}" method="post">@csrf

		@if ($errors->any())
			<div class="mb-3 p-3 bg-red-50 border border-red-200 text-red-700 rounded">
				<ul class="mb-0">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<label class="block text-sm">Title</label>
		<input name="title" class="w-full border rounded p-2 mb-3" value="{{ old('title') }}">

		<label class="block text-sm">Description</label>
		<textarea name="description" class="w-full border rounded p-2 mb-4">{{ old('description') }}</textarea>

		<div class="flex justify-end">
			<a href="{{ route('courses.index') }}" class="mr-2 px-4 py-2">Cancel</a>
			<button type="submit" class="px-4 py-2 bg-white text-blue-600 border border-blue-100 rounded hover:bg-blue-50">Save</button>
		</div>

	</form>
</div>

@endsection
