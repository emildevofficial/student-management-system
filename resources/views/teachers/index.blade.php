@extends('layout')
@section('content')

<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-semibold">Teachers</h1>
        <div>
            <button @click="showCreateTeacher=true" class="inline-flex items-center px-3 py-2 bg-white text-blue-600 border border-blue-100 rounded hover:bg-blue-50">
                <i class="fa fa-plus mr-2 text-blue-600"></i> Add Teacher
            </button>
        </div>
</div>

@if (session('flash_message'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded">{{ session('flash_message') }}</div>
@endif

<div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-white text-blue-600 font-medium">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Subject</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">Mobile</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $item)
            <tr class="border-t">
                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                <td class="px-4 py-3">{{ $item->name }}</td>
                <td class="px-4 py-3">{{ $item->subject }}</td>
                <td class="px-4 py-3">{{ $item->email }}</td>
                <td class="px-4 py-3">{{ $item->mobile }}</td>
                <td class="px-4 py-3">
                    <a href="{{ route('teachers.show', $item->id) }}" class="inline-block mr-2 text-blue-600">View</a>
                    <button @click="openEditTeacher({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ addslashes($item->subject) }}', '{{ addslashes($item->email) }}', '{{ addslashes($item->mobile) }}')" class="inline-block mr-2 text-indigo-600">Edit</button>
                    <form method="POST" action="{{ route('teachers.destroy', $item->id) }}" class="inline">
                        @method('DELETE') @csrf
                        <button type="submit" onclick="return confirm('Confirm delete?')" class="text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div x-data="{showCreateTeacher:false, showEditTeacher:false, edit:{}}">
    <template x-if="showCreateTeacher">
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-bold mb-4">Add Teacher</h3>
                <form method="POST" action="{{ route('teachers.store') }}">@csrf
                    <label class="block text-sm">Name</label>
                    <input name="name" class="w-full border rounded p-2 mb-2" required>
                    <label class="block text-sm">Subject</label>
                    <input name="subject" class="w-full border rounded p-2 mb-2">
                    <label class="block text-sm">Email</label>
                    <input name="email" class="w-full border rounded p-2 mb-2">
                    <label class="block text-sm">Mobile</label>
                    <input name="mobile" class="w-full border rounded p-2 mb-4">
                    <div class="flex justify-end">
                        <button type="button" @click="showCreateTeacher=false" class="mr-2 px-4 py-2">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <template x-if="showEditTeacher">
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-bold mb-4">Edit Teacher</h3>
                <form :action="`/teachers/${edit.id}`" method="POST">@csrf @method('PUT')
                    <label class="block text-sm">Name</label>
                    <input name="name" x-model="edit.name" class="w-full border rounded p-2 mb-2" required>
                    <label class="block text-sm">Subject</label>
                    <input name="subject" x-model="edit.subject" class="w-full border rounded p-2 mb-2">
                    <label class="block text-sm">Email</label>
                    <input name="email" x-model="edit.email" class="w-full border rounded p-2 mb-2">
                    <label class="block text-sm">Mobile</label>
                    <input name="mobile" x-model="edit.mobile" class="w-full border rounded p-2 mb-4">
                    <div class="flex justify-end">
                        <button type="button" @click="showEditTeacher=false" class="mr-2 px-4 py-2">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

</div>

<script>
function openEditTeacher(id,name,subject,email,mobile){
    const root = document.querySelector('[x-data]');
    root.__x.$data.edit = {id,name,subject,email,mobile};
    root.__x.$data.showEditTeacher = true;
}
</script>

@endsection
