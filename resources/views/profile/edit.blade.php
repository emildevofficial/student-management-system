@extends('layouts.layout')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
            <i class="fa fa-user-circle text-blue-600"></i>
            Edit Profile
        </h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Update your personal information and preferences</p>
    </div>

    <!-- Profile Card -->
    <div class="card">
        <!-- Current Profile Photo -->
        <div class="flex items-center gap-6 mb-8 pb-6 border-b border-gray-200 dark:border-gray-600">
            <div class="relative">
                <img src="{{ asset('profile.png') }}" 
                     alt="Profile Photo" 
                     class="w-20 h-20 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-lg">
                <div class="absolute bottom-0 right-0 bg-blue-600 text-white p-1 rounded-full">
                    <i class="fa fa-camera text-xs"></i>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name ?? 'Admin User' }}</h3>
                <p class="text-gray-600 dark:text-gray-400">{{ Auth::user()->email ?? 'admin@school.com' }}</p>
                <p class="text-sm text-blue-600 dark:text-blue-400 mt-1">Super Administrator</p>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                <div class="flex items-center gap-3">
                    <i class="fa fa-check-circle text-green-600 dark:text-green-400"></i>
                    <span class="text-green-800 dark:text-green-300 font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Edit Form -->
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fa fa-user mr-2 text-blue-600"></i>Full Name
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name"
                           value="{{ old('name', Auth::user()->name ?? 'Admin User') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-colors"
                           placeholder="Enter your full name">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-2">
                            <i class="fa fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fa fa-envelope mr-2 text-blue-600"></i>Email Address
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email"
                           value="{{ old('email', Auth::user()->email ?? 'admin@school.com') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-colors"
                           placeholder="Enter your email address">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-2">
                            <i class="fa fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Change Section -->
                <div class="pt-4 border-t border-gray-200 dark:border-gray-600">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <i class="fa fa-lock text-amber-500"></i>
                        Change Password
                    </h4>
                    
                    <div class="space-y-4">
                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Current Password
                            </label>
                            <input type="password" 
                                   name="current_password" 
                                   id="current_password"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-colors"
                                   placeholder="Enter current password">
                            @error('current_password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-2">
                                    <i class="fa fa-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                New Password
                            </label>
                            <input type="password" 
                                   name="new_password" 
                                   id="new_password"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-colors"
                                   placeholder="Enter new password">
                            @error('new_password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-2">
                                    <i class="fa fa-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div>
                            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Confirm New Password
                            </label>
                            <input type="password" 
                                   name="new_password_confirmation" 
                                   id="new_password_confirmation"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-colors"
                                   placeholder="Confirm new password">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-6">
                    <button type="submit" 
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-semibold transition-colors flex items-center justify-center gap-2">
                        <i class="fa fa-save"></i>
                        Update Profile
                    </button>
                    
                    <a href="{{ route('dashboard') }}" 
                       class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors flex items-center justify-center gap-2">
                        <i class="fa fa-times"></i>
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Additional Information Card -->
    <div class="card mt-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <i class="fa fa-info-circle text-purple-600"></i>
            Account Information
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                    <i class="fa fa-calendar-alt text-green-600 dark:text-green-400"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Member Since</p>
                    <p class="font-semibold text-gray-900 dark:text-white">
                        {{ Auth::user()->created_at?->format('M d, Y') ?? 'Jan 01, 2024' }}
                    </p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                    <i class="fa fa-shield-alt text-blue-600 dark:text-blue-400"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Role</p>
                    <p class="font-semibold text-gray-900 dark:text-white">Super Administrator</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add some interactive features
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-blue-200', 'dark:ring-blue-800');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-blue-200', 'dark:ring-blue-800');
        });
    });
});
</script>
@endsection