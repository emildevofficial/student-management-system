@extends('layouts.layout')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-6 transform hover:scale-[1.01] transition-all duration-300">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-calendar-plus text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Edit Event</h2>
                            <p class="text-blue-100 text-sm">Update event information</p>
                        </div>
                    </div>
                    <a href="{{ route('events.index') }}" class="text-white/80 hover:text-white transition-colors">
                        <i class="fa-solid fa-times text-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                <form action="{{ route('events.update', $event->id) }}" method="POST" id="eventForm">
                    @csrf
                    @method('PUT')

                    <!-- Error Display -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg animate-pulse">
                            <div class="flex items-center mb-2">
                                <i class="fa-solid fa-exclamation-triangle text-red-500 mr-2"></i>
                                <h3 class="text-red-800 font-semibold">Please fix the following errors:</h3>
                            </div>
                            <ul class="text-red-700 text-sm list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Event Title -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fa-solid fa-heading mr-2 text-blue-500"></i>
                            Event Title
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                name="title" 
                                value="{{ old('title', $event->title) }}"
                                placeholder="Enter event title..."
                                class="w-full border-2 border-gray-200 rounded-xl p-4 pl-12 text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                required
                            >
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fa-solid fa-pen"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Event Type -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fa-solid fa-tag mr-2 text-purple-500"></i>
                            Event Type
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @php
                                $eventTypes = [
                                    'assignment' => ['icon' => 'fa-file-alt', 'color' => 'orange', 'label' => 'Assignment'],
                                    'exam' => ['icon' => 'fa-graduation-cap', 'color' => 'red', 'label' => 'Exam'],
                                    'holiday' => ['icon' => 'fa-umbrella-beach', 'color' => 'green', 'label' => 'Holiday'],
                                    'other' => ['icon' => 'fa-calendar', 'color' => 'blue', 'label' => 'Other']
                                ];
                            @endphp
                            
                            @foreach($eventTypes as $value => $type)
                                <div class="relative">
                                    <input 
                                        type="radio" 
                                        name="type" 
                                        value="{{ $value }}" 
                                        id="{{ $value }}" 
                                        class="hidden peer" 
                                        {{ old('type', $event->type) == $value ? 'checked' : '' }}
                                        required
                                    >
                                    <label for="{{ $value }}" 
                                           class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer peer-checked:border-{{ $type['color'] }}-500 peer-checked:bg-{{ $type['color'] }}-50 transition-all duration-200">
                                        <i class="fa-solid {{ $type['icon'] }} text-{{ $type['color'] }}-600 text-xl mb-2"></i>
                                        <span class="text-sm font-medium text-gray-700">{{ $type['label'] }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Start Date -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fa-solid fa-play mr-2 text-green-500"></i>
                            Start Date
                        </label>
                        <div class="relative">
                            <input 
                                type="date" 
                                name="start_date" 
                                value="{{ old('start_date', $event->start_date) }}"
                                class="w-full border-2 border-gray-200 rounded-xl p-4 pl-12 text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200"
                                required
                            >
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fa-solid fa-calendar"></i>
                            </div>
                        </div>
                    </div>

                    <!-- End Date -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fa-solid fa-flag mr-2 text-blue-500"></i>
                            End Date <span class="text-gray-400 font-normal ml-1">(Optional)</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="date" 
                                name="end_date" 
                                value="{{ old('end_date', $event->end_date) }}"
                                class="w-full border-2 border-gray-200 rounded-xl p-4 pl-12 text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                            >
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                        <a 
                            href="{{ route('events.index') }}" 
                            class="flex items-center px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-200 transform hover:scale-105"
                        >
                            <i class="fa-solid fa-arrow-left mr-2"></i>
                            Back to Events
                        </a>
                        <button 
                            type="submit" 
                            class="flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200"
                            id="submitButton"
                        >
                            <i class="fa-solid fa-check-circle mr-2"></i>
                            Update Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('eventForm');
        const submitButton = document.getElementById('submitButton');

        // Add loading state to form submission
        form.addEventListener('submit', function() {
            submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Updating...';
            submitButton.disabled = true;
        });

        // Set minimum date for start_date to today
        const startDateInput = document.querySelector('input[name="start_date"]');
        const today = new Date().toISOString().split('T')[0];
        startDateInput.min = today;

        // Set minimum date for end_date based on start_date
        const endDateInput = document.querySelector('input[name="end_date"]');
        startDateInput.addEventListener('change', function() {
            endDateInput.min = this.value;
        });
    });
</script>
@endsection