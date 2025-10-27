@extends('layouts.layout')

@section('content')
<div 
    x-data="{
        showCreateTeacher: false,
        showEditTeacher: false,
        showViewTeacher: false,
        edit: { id: null, name: '', subject: '', email: '', mobile: '' },
        view: { id: null, name: '', subject: '', email: '', mobile: '' },
        openEditTeacher(id, name, subject, email, mobile) {
            this.edit = { id, name, subject, email, mobile };
            this.showEditTeacher = true;
        },
        openViewTeacher(id, name, subject, email, mobile) {
            this.view = { id, name, subject, email, mobile };
            this.showViewTeacher = true;
        }
    }"
    @keydown.escape.window="showCreateTeacher=false; showEditTeacher=false; showViewTeacher=false"
    class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 px-6 py-8"
>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Teachers</h1>
            <p class="text-gray-600 mt-1">Manage teaching staff and their information</p>
        </div>
        <button 
            @click="showCreateTeacher = true" 
            class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 shadow-sm transition-colors duration-200"
        >
            <i class="fa fa-plus mr-2"></i> Add Teacher
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

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Teachers</p>
                    <h2 class="text-2xl font-bold mt-1 text-gray-800">{{ $teachers->count() }}</h2>
                </div>
                <div class="bg-blue-50 p-3 rounded-full">
                    <i class="fa fa-chalkboard-teacher text-blue-600 text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Subjects</p>
                    <h2 class="text-2xl font-bold mt-1 text-gray-800">{{ $teachers->pluck('subject')->unique()->count() }}</h2>
                </div>
                <div class="bg-green-50 p-3 rounded-full">
                    <i class="fa fa-book text-green-600 text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Active</p>
                    <h2 class="text-2xl font-bold mt-1 text-gray-800">{{ $teachers->count() }}</h2>
                </div>
                <div class="bg-emerald-50 p-3 rounded-full">
                    <i class="fa fa-user-check text-emerald-600 text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">This Month</p>
                    <h2 class="text-2xl font-bold mt-1 text-gray-800">+0</h2>
                </div>
                <div class="bg-purple-50 p-3 rounded-full">
                    <i class="fa fa-chart-line text-purple-600 text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wider">#</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wider">Teacher</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700 text-xs uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-4 text-right font-semibold text-gray-700 text-xs uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($teachers as $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 text-gray-500 font-medium">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                        {{ strtoupper(substr($item->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $item->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $item->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $item->subject ?: 'Not specified' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-gray-900">{{ $item->mobile ?: 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end space-x-2">
                                    <button 
                                        @click="openViewTeacher({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ addslashes($item->subject) }}', '{{ addslashes($item->email) }}', '{{ addslashes($item->mobile) }}')" 
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors duration-200 text-xs font-medium"
                                        title="View Teacher"
                                    >
                                        <i class="fa fa-eye mr-1.5"></i> View
                                    </button>

                                    <button 
                                        @click="openEditTeacher({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ addslashes($item->subject) }}', '{{ addslashes($item->email) }}', '{{ addslashes($item->mobile) }}')" 
                                        class="inline-flex items-center px-3 py-1.5 bg-amber-50 text-amber-700 rounded-lg hover:bg-amber-100 transition-colors duration-200 text-xs font-medium"
                                        title="Edit Teacher"
                                    >
                                        <i class="fa fa-edit mr-1.5"></i> Edit
                                    </button>

                                    <form method="POST" action="{{ route('teachers.destroy', $item->id) }}" onsubmit="return confirm('Are you sure you want to delete this teacher?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors duration-200 text-xs font-medium" title="Delete Teacher">
                                            <i class="fa fa-trash mr-1.5"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Modal -->
    <template x-if="showCreateTeacher">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 transform transition-all">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fa fa-user-plus text-blue-500 mr-2"></i> Add New Teacher
                    </h3>
                </div>
                <form method="POST" action="{{ route('teachers.store') }}">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input 
                                name="name" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                placeholder="Enter teacher's name"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input 
                                name="subject" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                placeholder="Enter subject"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input 
                                name="email" 
                                type="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                placeholder="Enter email address"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mobile</label>
                            <input 
                                name="mobile" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                placeholder="Enter mobile number"
                            >
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                        <button 
                            type="button" 
                            @click="showCreateTeacher=false" 
                            class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200 font-medium"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium"
                        >
                            <i class="fa fa-save mr-1.5"></i> Save Teacher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- Edit Modal -->
    <template x-if="showEditTeacher">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 transform transition-all">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fa fa-edit text-amber-500 mr-2"></i> Edit Teacher
                    </h3>
                </div>
                <form :action="`/teachers/${edit.id}`" method="POST">
                    @csrf @method('PUT')
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input 
                                name="name" 
                                x-model="edit.name"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors duration-200" 
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input 
                                name="subject" 
                                x-model="edit.subject"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors duration-200" 
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input 
                                name="email" 
                                x-model="edit.email"
                                type="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors duration-200" 
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mobile</label>
                            <input 
                                name="mobile" 
                                x-model="edit.mobile"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors duration-200" 
                            >
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                        <button 
                            type="button" 
                            @click="showEditTeacher=false" 
                            class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200 font-medium"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-4 py-2.5 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors duration-200 font-medium"
                        >
                            <i class="fa fa-save mr-1.5"></i> Update Teacher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- View Modal -->
    <template x-if="showViewTeacher">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 transform transition-all">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fa fa-eye text-blue-500 mr-2"></i> Teacher Details
                    </h3>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Teacher Avatar and Basic Info -->
                    <div class="flex flex-col items-center text-center mb-4">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-2xl mb-3">
                            <span x-text="view.name ? view.name.charAt(0).toUpperCase() : ''"></span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800" x-text="view.name"></h4>
                        <p class="text-gray-500" x-text="view.subject || 'No subject specified'"></p>
                    </div>

                    <!-- Details Grid -->
                    <div class="space-y-4">
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                            <div class="flex items-start">
                                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                    <i class="fa fa-envelope text-blue-600"></i>
                                </div>
                                <div>
                                    <h5 class="text-sm font-semibold text-blue-800 uppercase tracking-wide mb-1">Email</h5>
                                    <p class="text-gray-800 font-medium" x-text="view.email || 'N/A'"></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 rounded-lg p-4 border border-green-100">
                            <div class="flex items-start">
                                <div class="bg-green-100 p-2 rounded-lg mr-3">
                                    <i class="fa fa-phone-alt text-green-600"></i>
                                </div>
                                <div>
                                    <h5 class="text-sm font-semibold text-green-800 uppercase tracking-wide mb-1">Mobile</h5>
                                    <p class="text-gray-800 font-medium" x-text="view.mobile || 'N/A'"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end p-6 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                    <button 
                        @click="showViewTeacher=false" 
                        class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200 font-medium"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </template>

</div>
@endsection