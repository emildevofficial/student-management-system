@extends('layout')
@section('content')

<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-semibold">Courses</h1>
    <div>
        <a href="{{ route('courses.create') }}" class="inline-flex items-center px-3 py-2 bg-white text-blue-600 border border-blue-100 rounded hover:bg-blue-50">
            <i class="fa fa-plus mr-2 text-blue-600"></i> Add Course
        </a>
    </div>
</div>

@if(session('flash_message'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded">{{ session('flash_message') }}</div>
@endif

@if($courses->isEmpty())
    <div class="p-6 bg-white rounded shadow-sm text-gray-600">No courses yet.</div>
@else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow overflow-hidden">
            <thead class="bg-white text-blue-600 font-medium">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Title</th>
                    <th class="px-4 py-3 text-left">Description</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $item)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ $item->title }}</td>
                    <td class="px-4 py-3">{{ \Illuminate\Support\Str::limit($item->description, 80) }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('courses.show', $item->id) }}" class="inline-block text-blue-600 mr-2">View</a>
                        <a href="{{ route('courses.edit', $item->id) }}" class="inline-block text-indigo-600 mr-2">Edit</a>
                        <form action="{{ route('courses.destroy', $item->id) }}" method="post" class="inline">@csrf @method('DELETE')
                            <button class="text-red-600" onclick="return confirm('Delete course?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection
