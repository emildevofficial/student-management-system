@extends('layouts.layout')
@section('content')

<div x-data="{
        showCreateCourse: false,
        showEditCourse: false,
        showViewCourse: false,
        edit: { id: null, title: '', description: '' },
        view: { id: null, title: '', description: '' },
        openEditCourse(id, title, description) {
            this.edit = { id, title, description };
            this.showEditCourse = true;
        },
        openViewCourse(id, title, description) {
            this.view = { id, title, description };
            this.showViewCourse = true;
        }
    }"
    @keydown.escape.window="showCreateCourse=false; showEditCourse=false; showViewCourse=false"
    class="min-h-screen bg-gray-50 px-6 py-8"
>

    <!-- Simplified Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Course Management</h1>
                <p class="text-gray-600 mt-1">Manage your educational programs and curriculum</p>
            </div>
            <button 
                @click="showCreateCourse = true"
                class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm"
            >
                <i class="fa fa-plus mr-2"></i>
                New Course
            </button>
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
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">All Courses</h2>
                    <p class="text-sm text-gray-600 mt-1">Total: {{ $courses->count() }} courses</p>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="text-sm text-gray-500">
                        <i class="fa fa-filter mr-1"></i>
                        Filter
                    </div>
                    <div class="text-sm text-gray-500">
                        <i class="fa fa-sort mr-1"></i>
                        Sort
                    </div>
                </div>
            </div>
        </div>

        @if($courses->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa fa-book text-gray-400 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No courses created</h3>
                <p class="text-gray-500 mb-4">Get started by creating your first course</p>
                <button 
                    @click="showCreateCourse = true"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                >
                    <i class="fa fa-plus mr-2"></i>
                    Create Course
                </button>
            </div>
        @else
            <!-- Courses Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr class="border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($courses as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- Course Name -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fa fa-book text-blue-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $item->title }}</div>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Description -->
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs">
                                        {{ $item->description ? \Illuminate\Support\Str::limit($item->description, 80) : 'No description' }}
                                    </div>
                                </td>
                                
                                <!-- Students -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">0</div>
                                    <div class="text-xs text-gray-500">enrolled</div>
                                </td>
                                
                                <!-- Created Date -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</div>
                                </td>
                                
                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <button 
                                            @click="openViewCourse({{ $item->id }}, '{{ addslashes($item->title) }}', '{{ addslashes($item->description) }}')"
                                            class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors text-xs"
                                        >
                                            <i class="fa fa-eye mr-1.5"></i> View
                                        </button>
                                        <button 
                                            @click="openEditCourse({{ $item->id }}, '{{ addslashes($item->title) }}', '{{ addslashes($item->description) }}')"
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors text-xs"
                                        >
                                            <i class="fa fa-edit mr-1.5"></i> Edit
                                        </button>
                                        <form action="{{ route('courses.destroy', $item->id) }}" method="post" class="inline">
                                            @csrf @method('DELETE')
                                            <button 
                                                onclick="return confirm('Are you sure you want to delete this course?')"
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

    <!-- Create Course Modal -->
    <template x-if="showCreateCourse">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Create New Course</h3>
                </div>
                <form method="POST" action="{{ route('courses.store') }}">
                    @csrf
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Course Title</label>
                            <input 
                                name="title" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="Enter course title"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea 
                                name="description" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                rows="4"
                                placeholder="Course description..."
                            ></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                        <button 
                            type="button" 
                            @click="showCreateCourse=false" 
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            Create Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- Edit Course Modal -->
    <template x-if="showEditCourse">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Course</h3>
                </div>
                <form :action="`/courses/${edit.id}`" method="POST">
                    @csrf @method('PUT')
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Course Title</label>
                            <input 
                                name="title" 
                                x-model="edit.title"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea 
                                name="description" 
                                x-model="edit.description"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                rows="4"
                            ></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                        <button 
                            type="button" 
                            @click="showEditCourse=false" 
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            Update Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- View Course Modal -->
    <template x-if="showViewCourse">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900" x-text="view.title"></h3>
                </div>
                <div class="p-6">
                    <h4 class="text-sm font-medium text-gray-700 uppercase tracking-wide mb-3">Description</h4>
                    <p class="text-gray-700" x-text="view.description || 'No description provided'"></p>
                </div>
                <div class="flex justify-end p-6 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                    <button 
                        @click="showViewCourse=false" 
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