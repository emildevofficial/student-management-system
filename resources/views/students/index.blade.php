@extends('layout')
@section('content')

<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-semibold">Students</h1>
    <div>
        <button @click="showCreate=true" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            <i class="fa fa-plus mr-2"></i> Add Student
        </button>
    </div>
</div>

@if (session('flash_message'))
    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded">{{ session('flash_message') }}</div>
@endif

<div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-gray-50 text-gray-600">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Address</th>
                <th class="px-4 py-3 text-left">Mobile</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $item)
            <tr class="border-t">
                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                <td class="px-4 py-3">{{ $item->name }}</td>
                <td class="px-4 py-3">{{ $item->address }}</td>
                <td class="px-4 py-3">{{ $item->mobile }}</td>
                <td class="px-4 py-3">
                    <a href="{{ route('students.show', $item->id) }}" class="inline-block mr-2 text-blue-600">View</a>
                    <button @click="openEdit({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ addslashes($item->address) }}', '{{ addslashes($item->mobile) }}')" class="inline-block mr-2 text-indigo-600">Edit</button>
                    <form method="POST" action="{{ route('students.destroy', $item->id) }}" class="inline">
                        @method('DELETE') @csrf
                        <button type="submit" onclick="return confirm('Confirm delete?')" class="text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Alpine modals -->
<div x-data="{
    showCreate:false,
    showEdit:false,
    edit:{id:null,name:'',address:'',mobile:''},
    openEdit(id,name,address,mobile){ this.edit={id,name,address,mobile}; this.showEdit=true }
}">

    <template x-if="showCreate">
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-bold mb-4">Add Student</h3>
                <form method="POST" action="{{ route('students.store') }}">
                    @csrf
                    <label class="block text-sm">Name</label>
                    <input name="name" class="w-full border rounded p-2 mb-2" required>
                    <label class="block text-sm">Address</label>
                    <input name="address" class="w-full border rounded p-2 mb-2" required>
                    <label class="block text-sm">Mobile</label>
                    <input name="mobile" class="w-full border rounded p-2 mb-4" required>
                    <div class="flex justify-end">
                        <button type="button" @click="showCreate=false" class="mr-2 px-4 py-2">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <template x-if="showEdit">
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-bold mb-4">Edit Student</h3>
                <form :action="`/students/${edit.id}`" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="block text-sm">Name</label>
                    <input name="name" x-model="edit.name" class="w-full border rounded p-2 mb-2" required>
                    <label class="block text-sm">Address</label>
                    <input name="address" x-model="edit.address" class="w-full border rounded p-2 mb-2" required>
                    <label class="block text-sm">Mobile</label>
                    <input name="mobile" x-model="edit.mobile" class="w-full border rounded p-2 mb-4" required>
                    <div class="flex justify-end">
                        <button type="button" @click="showEdit=false" class="mr-2 px-4 py-2">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

</div>

@endsection
