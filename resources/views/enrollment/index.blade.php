@extends('layout')
@section('content')

<div class="flex items-center justify-between mb-4">
	<h1 class="text-xl font-semibold">Enrollment</h1>
	<div>
		<a href="{{ route('enrollment.create') }}" class="inline-flex items-center px-3 py-2 bg-white text-blue-600 border border-blue-100 rounded hover:bg-blue-50">
			<i class="fa fa-plus mr-2 text-blue-600"></i> Enroll Student
		</a>
	</div>
</div>

@if(session('flash_message'))
	<div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded">{{ session('flash_message') }}</div>
@endif

@if($enrollments->isEmpty())
	<div class="p-6 bg-white rounded shadow-sm text-gray-600">No enrollments yet.</div>
@else
	<div class="overflow-x-auto">
		<table class="min-w-full bg-white rounded shadow overflow-hidden">
			<thead class="bg-white text-blue-600 font-medium">
				<tr>
					<th class="px-4 py-3 text-left">#</th>
					<th class="px-4 py-3 text-left">Student</th>
					<th class="px-4 py-3 text-left">Course</th>
					<th class="px-4 py-3 text-left">Enrolled At</th>
				</tr>
			</thead>
			<tbody>
				@foreach($enrollments as $item)
				<tr class="border-t">
					<td class="px-4 py-3">{{ $loop->iteration }}</td>
					<td class="px-4 py-3">{{ $item->student->name ?? 'N/A' }}</td>
					<td class="px-4 py-3">{{ $item->course->title ?? 'N/A' }}</td>
					<td class="px-4 py-3">{{ $item->enrolled_at }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endif

@endsection
