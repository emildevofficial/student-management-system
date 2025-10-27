@extends('layouts.layout')
@section('content')

<div x-data="{
        showCreateEnrollment: false,
        showEditEnrollment: false,
        showViewEnrollment: false,
        search: '',
        edit: { id: null, student_id: '', course_id: '', enrolled_at: '' },
        view: { student_name: '', course_title: '', enrolled_at: '' },
        openEditEnrollment(id, student_id, course_id, enrolled_at) {
            this.edit = { id, student_id, course_id, enrolled_at };
            this.showEditEnrollment = true;
        },
        openViewEnrollment(student_name, course_title, enrolled_at) {
            this.view = { student_name, course_title, enrolled_at };
            this.showViewEnrollment = true;
        }
    }"
    @keydown.escape.window="showCreateEnrollment=false; showEditEnrollment=false; showViewEnrollment=false"
    class="min-h-screen bg-gray-50 px-6 py-8"
>

    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Student Enrollments</h1>
                <p class="text-gray-600 mt-1">Manage student course registrations and enrollment data</p>
            </div>
            <button 
                @click="showCreateEnrollment = true"
                class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm"
            >
                <i class="fa fa-user-plus mr-2"></i>
                New Enrollment
            </button>
        </div>
    </div>

    <!-- Search and Stats -->
    <div class="mb-6 flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <div class="relative">
                <input 
                    type="text" 
                    placeholder="Search enrollments by student or course..." 
                    x-model="search"
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                <i class="fa fa-search absolute left-3 top-3.5 text-gray-400"></i>
            </div>
        </div>
        <div class="flex items-center space-x-2 text-sm text-gray-600">
            <span>Total: {{ $enrollments->count() }} enrollments</span>
        </div>
    </div>

    <!-- Flash Message -->
    @if(session('flash_message'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
            <div class="flex items-center">
                <i class="fa fa-check-circle text-green-500 mr-2"></i>
                {{ session('flash_message') }}
            </div>
        </div>
    @endif

    <!-- Content Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <!-- Card Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-900">All Enrollments</h2>
        </div>

        @if($enrollments->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa fa-user-graduate text-gray-400 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No enrollments found</h3>
                <p class="text-gray-500 mb-4">Start by enrolling a student in a course</p>
                <button 
                    @click="showCreateEnrollment = true"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                >
                    <i class="fa fa-user-plus mr-2"></i>
                    Create Enrollment
                </button>
            </div>
        @else
            <!-- Enrollments Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr class="border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrollment Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($enrollments as $item)
                            <tr class="hover:bg-gray-50 transition-colors" 
                                x-show="'{{ strtolower($item->student->name ?? '') }} {{ strtolower($item->course->title ?? '') }}'.includes(search.toLowerCase())">
                                <!-- Student -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fa fa-user text-blue-600 text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $item->student->name ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Course -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fa fa-book text-green-600 text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $item->course->title ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Enrollment Date -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($item->enrolled_at)->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->enrolled_at)->diffForHumans() }}</div>
                                </td>
                                
                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fa fa-check-circle mr-1"></i>
                                        Active
                                    </span>
                                </td>
                                
                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <button 
                                            @click="openViewEnrollment('{{ addslashes($item->student->name ?? '') }}', '{{ addslashes($item->course->title ?? '') }}', '{{ $item->enrolled_at }}')"
                                            class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors text-xs"
                                        >
                                            <i class="fa fa-eye mr-1.5"></i> View
                                        </button>
                                        <button 
                                            @click="openEditEnrollment({{ $item->id }}, '{{ $item->student_id }}', '{{ $item->course_id }}', '{{ $item->enrolled_at }}')"
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors text-xs"
                                        >
                                            <i class="fa fa-edit mr-1.5"></i> Edit
                                        </button>
                                        <form action="{{ route('enrollments.destroy', $item->id) }}" method="post" class="inline">
                                            @csrf @method('DELETE')
                                            <button 
                                                onclick="return confirm('Are you sure you want to delete this enrollment?')"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors text-xs"
                                            >
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
        @endif
    </div>

    <!-- Create Enrollment Modal -->
    <template x-if="showCreateEnrollment">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Enroll Student</h3>
                </div>
                <form method="POST" action="{{ route('enrollments.store') }}">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Student Name</label>
                            <input 
                                type="text" 
                                name="student_name" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="Enter student name"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Course Title</label>
                            <input 
                                type="text" 
                                name="course_title" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="Enter course title"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Enrollment Date</label>
                            <input 
                                type="date" 
                                name="enrolled_at" 
                                value="{{ date('Y-m-d') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                required
                            >
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                        <button 
                            type="button" 
                            @click="showCreateEnrollment=false" 
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            Enroll Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- Edit Enrollment Modal -->
    <template x-if="showEditEnrollment">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Enrollment</h3>
                </div>
                <form :action="`/enrollments/${edit.id}`" method="POST">
                    @csrf @method('PUT')
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Student Name</label>
                            <input 
                                type="text" 
                                name="student_name" 
                                x-model="edit.student_name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Course Title</label>
                            <input 
                                type="text" 
                                name="course_title" 
                                x-model="edit.course_title"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Enrollment Date</label>
                            <input 
                                type="date" 
                                name="enrolled_at" 
                                x-model="edit.enrolled_at"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                required
                            >
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                        <button 
                            type="button" 
                            @click="showEditEnrollment=false" 
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            Update Enrollment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- View Enrollment Modal -->
    <template x-if="showViewEnrollment">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Enrollment Details</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fa fa-user text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Student</p>
                            <p class="font-medium text-gray-900" x-text="view.student_name"></p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fa fa-book text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Course</p>
                            <p class="font-medium text-gray-900" x-text="view.course_title"></p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fa fa-calendar text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Enrollment Date</p>
                            <p class="font-medium text-gray-900" x-text="view.enrolled_at"></p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end p-6 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                    <button 
                        @click="showViewEnrollment=false" 
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </template>

</div>

@endsection