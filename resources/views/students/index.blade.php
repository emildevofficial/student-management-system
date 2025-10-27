@extends('layouts.layout')

@section('content')
<div 
    x-data="{
        showCreate:false,
        showEdit:false,
        edit:{id:null,name:'',address:'',mobile:''},
        openEdit(id,name,address,mobile){ this.edit={id,name,address,mobile}; this.showEdit=true }
    }" 
    class="p-6 bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen"
>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Students</h1>
            <p class="text-gray-600 mt-1">Manage your student records</p>
        </div>
        <button 
            @click="showCreate=true" 
            class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 shadow-sm transition-colors duration-200"
        >
            <i class="fa fa-plus mr-2"></i> Add Student
        </button>
    </div>

    <!-- Flash Message -->
    @if (session('flash_message'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg shadow-sm">
            <div class="flex items-center">
                <i class="fa fa-check-circle text-green-500 mr-2"></i>
                {{ session('flash_message') }}
            </div>
        </div>
    @endif

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wider">#</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wider">Address</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wider">Mobile</th>
                        <th class="px-6 py-4 text-right font-semibold text-gray-700 text-xs uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($students as $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 text-gray-500 font-medium">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fa fa-user text-blue-600 text-xs"></i>
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $item->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->address }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->mobile }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end space-x-2">
                                    <a 
                                        href="{{ route('students.show', $item->id) }}" 
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200 text-xs font-medium"
                                    >
                                        <i class="fa fa-eye mr-1.5"></i> View
                                    </a>
                                    <button 
                                        @click="openEdit({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ addslashes($item->address) }}', '{{ addslashes($item->mobile) }}')" 
                                        class="inline-flex items-center px-3 py-1.5 bg-amber-50 text-amber-700 rounded-lg hover:bg-amber-100 transition-colors duration-200 text-xs font-medium"
                                    >
                                        <i class="fa fa-edit mr-1.5"></i> Edit
                                    </button>
                                    <form method="POST" action="{{ route('students.destroy', $item->id) }}" class="inline">
                                        @method('DELETE') @csrf
                                        <button 
                                            type="submit" 
                                            onclick="return confirm('Are you sure you want to delete this student?')" 
                                            class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors duration-200 text-xs font-medium"
                                        >
                                            <i class="fa fa-trash mr-1.5"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-8">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fa fa-users text-gray-300 text-4xl mb-2"></i>
                                    <p class="text-gray-500">No students found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Modal -->
    <template x-if="showCreate">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 transform transition-all">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fa fa-user-plus text-blue-500 mr-2"></i> Add New Student
                    </h3>
                </div>
                <form method="POST" action="{{ route('students.store') }}">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input 
                                name="name" 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                placeholder="Enter student name"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input 
                                name="address" 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                placeholder="Enter student address"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mobile</label>
                            <input 
                                name="mobile" 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                placeholder="Enter mobile number"
                                required
                            >
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                        <button 
                            type="button" 
                            @click="showCreate=false" 
                            class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200 font-medium"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium"
                        >
                            <i class="fa fa-save mr-1.5"></i> Save Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- Edit Modal -->
    <template x-if="showEdit">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 transform transition-all">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fa fa-edit text-amber-500 mr-2"></i> Edit Student
                    </h3>
                </div>
                <form :action="`/students/${edit.id}`" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input 
                                name="name" 
                                x-model="edit.name" 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors" 
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input 
                                name="address" 
                                x-model="edit.address" 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors" 
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mobile</label>
                            <input 
                                name="mobile" 
                                x-model="edit.mobile" 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors" 
                                required
                            >
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                        <button 
                            type="button" 
                            @click="showEdit=false" 
                            class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200 font-medium"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-4 py-2.5 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors duration-200 font-medium"
                        >
                            <i class="fa fa-save mr-1.5"></i> Update Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection