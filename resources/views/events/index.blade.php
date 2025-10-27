@extends('layouts.layout')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">All Events</h1>
                <p class="text-gray-600 mt-2">Manage and view all scheduled events</p>
            </div>
            <a href="{{ route('events.create') }}" 
               class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center">
                <i class="fa-solid fa-plus mr-2"></i>
                Create New Event
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg animate-pulse">
                <div class="flex items-center">
                    <i class="fa-solid fa-check-circle text-green-500 mr-2"></i>
                    <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Events Grid -->
        @if($events->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200 transform hover:scale-[1.02] transition-all duration-300">
                        <!-- Event Header with Type-based Color -->
                        <div class="h-2 
                            @if($event->type == 'assignment') bg-orange-500
                            @elseif($event->type == 'exam') bg-red-500
                            @elseif($event->type == 'holiday') bg-green-500
                            @else bg-blue-500 @endif">
                        </div>
                        
                        <div class="p-6">
                            <!-- Event Type Badge -->
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold 
                                @if($event->type == 'assignment') bg-orange-100 text-orange-800
                                @elseif($event->type == 'exam') bg-red-100 text-red-800
                                @elseif($event->type == 'holiday') bg-green-100 text-green-800
                                @else bg-blue-100 text-blue-800 @endif">
                                <i class="fa-solid 
                                    @if($event->type == 'assignment') fa-file-alt
                                    @elseif($event->type == 'exam') fa-graduation-cap
                                    @elseif($event->type == 'holiday') fa-umbrella-beach
                                    @else fa-calendar @endif mr-1">
                                </i>
                                {{ ucfirst($event->type) }}
                            </div>

                            <!-- Event Title -->
                            <h3 class="text-xl font-bold text-gray-800 mt-3 mb-4 line-clamp-2">
                                {{ $event->title }}
                            </h3>

                            <!-- Event Dates -->
                            <div class="space-y-2">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fa-solid fa-play mr-2 text-blue-500"></i>
                                    <span class="font-medium">Start:</span>
                                    <span class="ml-1">
                                        @if($event->start_date)
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y') }}
                                        @else
                                            Not set
                                        @endif
                                    </span>
                                </div>
                                @if($event->end_date)
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fa-solid fa-flag mr-2 text-green-500"></i>
                                        <span class="font-medium">End:</span>
                                        <span class="ml-1">{{ \Carbon\Carbon::parse($event->end_date)->format('M j, Y') }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-100">
                                <span class="text-xs text-gray-500">
                                    @if($event->created_at)
                                        Created {{ $event->created_at->diffForHumans() }}
                                    @else
                                        Created recently
                                    @endif
                                </span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('events.edit', $event->id) }}" 
                                       class="text-blue-600 hover:text-blue-800 transition-colors"
                                       title="Edit Event">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-800 transition-colors"
                                                onclick="return confirm('Are you sure you want to delete this event?')"
                                                title="Delete Event">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-solid fa-calendar-plus text-blue-500 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 mb-3">No Events Found</h3>
                <p class="text-gray-500 mb-6">Get started by creating your first event</p>
                <a href="{{ route('events.create') }}" 
                   class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-3 rounded-xl font-semibold inline-flex items-center shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Create Your First Event
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection