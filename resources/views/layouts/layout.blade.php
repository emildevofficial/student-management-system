<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'Student Management System')</title>

    <!-- Tailwind CSS + Fonts + Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --sidebar-width: 220px;
            --navbar-height: 56px;
            --accent: #1d4ed8;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #f8fafc;
            color: #111827;
        }

        /* Dark mode styles */
        .dark {
            background: #0f172a;
            color: #f1f5f9;
        }

        .dark .topbar {
            background: #1e293b;
            border-bottom-color: #334155;
            color: #f1f5f9;
        }

        .dark .sidebar {
            background: #1e293b;
            border-right-color: #334155;
            color: #f1f5f9;
        }

        .dark .card {
            background: #1e293b;
            border-color: #334155;
            color: #e2e8f0;
        }

        .dark .event-item {
            background: #334155;
            border-color: #475569;
        }

        .dark .quick-action-btn {
            background: #334155;
            border-color: #475569;
        }

        .dark .calendar-day.current-month {
            color: #e2e8f0;
        }

        .dark .calendar-day:hover {
            background: #475569;
        }

        /* DASHBOARD SPECIFIC DARK MODE STYLES */
        .dark .page-content {
            background: #0f172a;
            color: #f1f5f9;
        }

        .dark main.app {
            background: #0f172a;
            color: #f1f5f9;
        }

        .dark .bg-white {
            background: #1e293b !important;
            border-color: #334155 !important;
            color: #e2e8f0 !important;
        }

        .dark .bg-gray-50 {
            background: #1e293b !important;
        }

        .dark .bg-gradient-to-br {
            background: linear-gradient(to bottom right, #0f172a, #1e293b) !important;
        }

        .dark .text-gray-800 {
            color: #e2e8f0 !important;
        }

        .dark .text-gray-600 {
            color: #94a3b8 !important;
        }

        .dark .text-gray-500 {
            color: #94a3b8 !important;
        }

        .dark .text-gray-700 {
            color: #cbd5e1 !important;
        }

        .dark .text-gray-900 {
            color: #e2e8f0 !important;
        }

        .dark .border-gray-100 {
            border-color: #334155 !important;
        }

        .dark .border-gray-200 {
            border-color: #475569 !important;
        }

        .dark .divide-gray-100 > * + * {
            border-color: #334155 !important;
        }

        .dark .hover\:bg-gray-50:hover {
            background: #334155 !important;
        }

        .dark .bg-blue-50 {
            background: #1e3a8a !important;
        }

        .dark .bg-purple-50 {
            background: #3730a3 !important;
        }

        .dark .bg-amber-50 {
            background: #78350f !important;
        }

        .dark .bg-green-50 {
            background: #065f46 !important;
        }

        .dark .bg-red-50 {
            background: #7f1d1d !important;
        }

        .dark .text-blue-600 {
            color: #60a5fa !important;
        }

        .dark .text-purple-600 {
            color: #a78bfa !important;
        }

        .dark .text-amber-600 {
            color: #fbbf24 !important;
        }

        .dark .text-green-600 {
            color: #34d399 !important;
        }

        .dark .text-red-600 {
            color: #f87171 !important;
        }

        .dark .bg-blue-100 {
            background: #1e40af !important;
        }

        .dark .bg-purple-100 {
            background: #5b21b6 !important;
        }

        .dark .bg-amber-100 {
            background: #92400e !important;
        }

        .dark .bg-green-100 {
            background: #047857 !important;
        }

        .dark .bg-red-100 {
            background: #991b1b !important;
        }

        .dark .border-blue-500 {
            border-color: #3b82f6 !important;
        }

        .dark .border-purple-500 {
            border-color: #8b5cf6 !important;
        }

        .dark .border-amber-500 {
            border-color: #f59e0b !important;
        }

        .dark .border-green-500 {
            border-color: #10b981 !important;
        }

        .dark .border-red-500 {
            border-color: #ef4444 !important;
        }

        /* ================= NAVBAR ================= */
        nav.topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--navbar-height);
            background: #fff;
            border-bottom: 1px solid #e6e6f0;
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 30;
            box-shadow: 0 1px 0 rgba(16, 24, 40, 0.03);
        }

        nav .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: #0f172a;
        }

        .dark nav .brand {
            color: #e2e8f0;
        }

        .nav-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-btn {
            position: relative;
            background: none;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #64748b;
        }

        .nav-btn:hover {
            background: #f1f5f9;
            color: #374151;
        }

        .dark .nav-btn:hover {
            background: #334155;
            color: #e2e8f0;
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid white;
        }

        .dark .notification-badge {
            border-color: #1e293b;
        }

        /* Profile Dropdown Styles */
        .profile-dropdown {
            position: relative;
        }

        .profile-btn {
            background: none;
            border: none;
            cursor: pointer;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .profile-btn:hover {
            transform: scale(1.05);
        }

        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border: 1px solid #e5e7eb;
            min-width: 160px;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
        }

        .profile-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dark .profile-menu {
            background: #1e293b;
            border-color: #334155;
        }

        .profile-menu-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s ease;
            border-bottom: 1px solid #f3f4f6;
        }

        .profile-menu-item:last-child {
            border-bottom: none;
        }

        .profile-menu-item:hover {
            background: #f8fafc;
            color: #1d4ed8;
        }

        .dark .profile-menu-item {
            color: #cbd5e1;
            border-bottom-color: #334155;
        }

        .dark .profile-menu-item:hover {
            background: #334155;
            color: #60a5fa;
        }

        /* ================= SIDEBAR ================= */
        aside.sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            padding-top: calc(var(--navbar-height) + 12px);
            background: #f7fafc;
            border-right: 1px solid #eef2f7;
            z-index: 20;
            overflow-y: auto;
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding-bottom: 2rem;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            color: #374151;
            text-decoration: none;
            border-left: 4px solid transparent;
            border-radius: 8px 0 0 8px;
            margin: 4px 8px;
            transition: background .12s ease, color .12s ease, transform .12s;
        }

        .sidebar a:hover {
            background: rgba(29, 78, 216, 0.06);
            color: var(--accent);
            transform: translateX(2px);
        }

        .sidebar a.active {
            background: rgba(29, 78, 216, 0.08);
            color: var(--accent);
            border-left-color: var(--accent);
            font-weight: 600;
        }

        .dark .sidebar {
            background: #1e293b;
            color: #f1f5f9;
        }

        .dark .sidebar a {
            color: #cbd5e1;
        }

        .dark .sidebar a:hover {
            background: rgba(29, 78, 216, 0.15);
            color: #60a5fa;
        }

        .dark .sidebar a.active {
            background: rgba(29, 78, 216, 0.2);
            color: #60a5fa;
            border-left-color: #60a5fa;
        }

        .sidebar a i {
            width: 20px;
            text-align: center;
            color: inherit;
        }

        /* ================= MAIN CONTENT ================= */
        main.app {
            display: flex;
            gap: 24px;
            align-items: flex-start;
            margin-left: var(--sidebar-width);
            margin-top: var(--navbar-height);
            padding: 20px 36px;
            min-height: calc(100vh - var(--navbar-height));
            background: #f8fafc;
        }

        .dark main.app {
            background: #0f172a;
            color: #f1f5f9;
        }

        .page-content {
            flex: 1;
            min-width: 0;
        }

        .dark .page-content {
            background: #0f172a;
            color: #f1f5f9;
        }

        /* ================= EVENTS PANEL ================= */
        .events-panel {
            width: 320px;
            flex-shrink: 0;
            align-self: flex-start;
            position: sticky;
            top: calc(var(--navbar-height) + 18px);
        }

        /* ================= RESPONSIVE ================= */
        @media(max-width:1024px) {
            aside.sidebar {
                position: relative;
                width: 100%;
                height: auto;
                padding-top: 12px;
            }

            main.app {
                margin-left: 0;
                margin-top: 0;
                padding: 16px;
                flex-direction: column;
            }

            .events-panel {
                width: 100%;
                position: relative;
                top: auto;
                margin-top: 16px;
            }
        }

        /* ================= CARD ================= */
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);
            border: 1px solid #f1f5f9;
        }

        .dark .card {
            background: #1e293b;
            color: #e2e8f0;
            border-color: #334155;
        }

        /* ================= MODERN EVENT STYLES ================= */
        .event-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #f1f5f9;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            background: #fafbfc;
        }

        .event-item:hover {
            background: #f8fafc;
            border-color: #e2e8f0;
            transform: translateY(-1px);
        }

        .dark .event-item {
            background: #334155;
            border-color: #475569;
            color: #e2e8f0;
        }

        .dark .event-item:hover {
            background: #475569;
            border-color: #64748b;
        }

        .event-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .event-content {
            flex: 1;
            min-width: 0;
        }

        .event-type {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .event-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .event-date {
            font-size: 0.75rem;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .dark .event-title {
            color: #e2e8f0;
        }

        .dark .event-date {
            color: #94a3b8;
        }

        /* ================= QUICK ACTIONS ================= */
        .quick-action-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .quick-action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 12px 8px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: white;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .quick-action-btn:hover {
            background: #f8fafc;
            border-color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .dark .quick-action-btn {
            background: #334155;
            border-color: #475569;
            color: #e2e8f0;
        }

        .dark .quick-action-btn:hover {
            background: #475569;
            border-color: #60a5fa;
        }

        .quick-action-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 6px;
        }

        .quick-action-text {
            font-size: 0.7rem;
            font-weight: 600;
            color: #374151;
            text-align: center;
        }

        .dark .quick-action-text {
            color: #e2e8f0;
        }

        /* ================= CALENDAR STYLES ================= */
        .calendar {
            width: 100%;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .calendar-nav {
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .calendar-nav:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .dark .calendar-nav {
            color: #94a3b8;
        }

        .dark .calendar-nav:hover {
            background: #475569;
            color: #e2e8f0;
        }

        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            margin-bottom: 4px;
        }

        .calendar-weekday {
            text-align: center;
            font-size: 0.7rem;
            font-weight: 600;
            color: #6b7280;
            padding: 4px 0;
        }

        .dark .calendar-weekday {
            color: #94a3b8;
        }

        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .calendar-day:hover {
            background: #f3f4f6;
        }

        .calendar-day.current-month {
            color: #374151;
            font-weight: 500;
        }

        .calendar-day.other-month {
            color: #d1d5db;
        }

        .calendar-day.today {
            background: #3b82f6;
            color: white;
            font-weight: 600;
        }

        .calendar-day.has-event::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 4px;
            background: #ef4444;
            border-radius: 50%;
        }

        .calendar-day.selected {
            background: #1d4ed8;
            color: white;
        }

        .dark .calendar-day.current-month {
            color: #e2e8f0;
        }

        .dark .calendar-day.other-month {
            color: #475569;
        }

        .dark .calendar-day:hover {
            background: #475569;
        }
    </style>
</head>

<body>
    <!-- ================= NAVBAR ================= -->
    <nav class="topbar">
        <div class="brand">
            <span class="text-xl">🎓</span>
            <span class="text-base">Student Management</span>
        </div>
        
        <div class="nav-actions">
            <!-- Notification Button -->
            <button class="nav-btn notification-btn" id="notificationBtn">
                <i class="fa fa-bell"></i>
                <span class="notification-badge"></span>
            </button>
            
            <!-- Dark/Light Mode Toggle -->
            <button class="nav-btn theme-toggle" id="themeToggle">
                <i class="fa fa-sun" id="sunIcon"></i>
                <i class="fa fa-moon hidden" id="moonIcon"></i>
            </button>

            <!-- Profile Dropdown -->
            <div class="profile-dropdown">
                <button class="profile-btn" id="profileBtn">
                    <img src="https://media.istockphoto.com/id/1130884625/vector/user-member-vector-icon-for-ui-user-interface-or-profile-face-avatar-app-in-circle-design.jpg?s=612x612&w=0&k=20&c=1ky-gNHiS2iyLsUPQkxAtPBWH1BZt0PKBB1WBtxQJRE=" alt="Profile" class="profile-img">
                </button>
                <div class="profile-menu" id="profileMenu">
                    <a href="{{ route('profile.edit') }}" class="profile-menu-item">
                        <i class="fa fa-user"></i>
                        <span>My Profile</span>
                    </a>
                    <a href="#" class="profile-menu-item">
                        <i class="fa fa-cog"></i>
                        <span>Settings</span>
                    </a>
                    <a href="#" class="profile-menu-item" id="logoutBtn">
                        <i class="fa fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ================= SIDEBAR ================= -->
    <aside class="sidebar" aria-label="Main navigation">
        <nav>
            <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="fa fa-home"></i> <span>Dashboard</span>
            </a>
            <a class="{{ request()->is('students*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                <i class="fa fa-user-graduate"></i> <span>Students</span>
            </a>
            <a class="{{ request()->is('teachers*') ? 'active' : '' }}" href="{{ route('teachers.index') }}">
                <i class="fa fa-chalkboard-teacher"></i> <span>Teachers</span>
            </a>
            <a class="{{ request()->is('courses*') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                <i class="fa fa-book"></i> <span>Courses</span>
            </a>
            <a class="{{ request()->is('enrollments*') ? 'active' : '' }}" href="{{ route('enrollments.index') }}">
                <i class="fa fa-clipboard-list"></i> <span>Enrollments</span>
            </a>
            <a class="{{ request()->is('payments*') ? 'active' : '' }}" href="{{ route('payments.index') }}">
                <i class="fa fa-credit-card"></i> <span>Payments</span>
            </a>
            <a class="{{ request()->is('events*') ? 'active' : '' }}" href="{{ route('events.index') }}">
                <i class="fa fa-calendar-alt"></i> <span>Events</span>
            </a>
        </nav>
    </aside>

    <!-- ================= MAIN CONTENT ================= -->
    <main class="app">
        <!-- Page Content -->
        <div class="page-content">
            @yield('content')
        </div>

        <!-- Right Events Panel -->
        <aside class="events-panel hidden lg:block">
            <!-- Upcoming Events Card -->
            <div class="card mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fa fa-calendar-alt text-blue-600"></i> 
                        <span>Upcoming Events</span>
                    </h3>
                    <a href="{{ route('events.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium transition-colors">
                        View All
                    </a>
                </div>

                @if(isset($events) && $events->count())
                    <div class="space-y-2">
                        @foreach($events as $event)
                            <div class="event-item">
                                <div class="event-icon 
                                    @if($event->type == 'holiday') bg-green-100 text-green-600
                                    @elseif($event->type == 'assignment') bg-blue-100 text-blue-600
                                    @elseif($event->type == 'exam') bg-red-100 text-red-600
                                    @else bg-purple-100 text-purple-600 @endif">
                                    <i class="fa 
                                        @if($event->type == 'holiday') fa-umbrella-beach
                                        @elseif($event->type == 'assignment') fa-file-alt
                                        @elseif($event->type == 'exam') fa-graduation-cap
                                        @else fa-calendar @endif text-sm">
                                    </i>
                                </div>
                                <div class="event-content">
                                    <div class="event-type 
                                        @if($event->type == 'holiday') text-green-600
                                        @elseif($event->type == 'assignment') text-blue-600
                                        @elseif($event->type == 'exam') text-red-600
                                        @else text-purple-600 @endif">
                                        {{ strtoupper($event->type) }}
                                    </div>
                                    <div class="event-title text-sm">
                                        {{ $event->title }}
                                    </div>
                                    <div class="event-date">
                                        <i class="fa fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6">
                        <i class="fa fa-calendar-times text-gray-300 text-3xl mb-3"></i>
                        <p class="text-gray-500 text-sm">No upcoming events</p>
                    </div>
                @endif

                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('events.create') }}"
                       class="block w-full text-center bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        <i class="fa fa-plus mr-2"></i>Add New Event
                    </a>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fa fa-bolt text-amber-500"></i> 
                    <span>Quick Actions</span>
                </h3>
                <div class="quick-action-grid">
                    <a href="{{ route('students.create') }}" class="quick-action-btn group">
                        <div class="quick-action-icon bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <span class="quick-action-text">Add Student</span>
                    </a>
                    
                    <a href="{{ route('payments.create') }}" class="quick-action-btn group">
                        <div class="quick-action-icon bg-green-100 text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <span class="quick-action-text">Record Payment</span>
                    </a>
                    
                    <a href="{{ route('events.create') }}" class="quick-action-btn group">
                        <div class="quick-action-icon bg-purple-100 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                            <i class="fa fa-calendar-plus"></i>
                        </div>
                        <span class="quick-action-text">Create Event</span>
                    </a>
                    
                    <a href="{{ route('courses.create') }}" class="quick-action-btn group">
                        <div class="quick-action-icon bg-amber-100 text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                            <i class="fa fa-book"></i>
                        </div>
                        <span class="quick-action-text">Add Course</span>
                    </a>
                </div>
            </div>

            <!-- Calendar Widget -->
            <div class="card">
                <div class="calendar">
                    <div class="calendar-header">
                        <button class="calendar-nav">
                            <i class="fa fa-chevron-left"></i>
                        </button>
                        <h3 class="text-md font-semibold text-gray-800">
                            {{ now()->format('F Y') }}
                        </h3>
                        <button class="calendar-nav">
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    </div>

                    <div class="calendar-weekdays">
                        <div class="calendar-weekday">Sun</div>
                        <div class="calendar-weekday">Mon</div>
                        <div class="calendar-weekday">Tue</div>
                        <div class="calendar-weekday">Wed</div>
                        <div class="calendar-weekday">Thu</div>
                        <div class="calendar-weekday">Fri</div>
                        <div class="calendar-weekday">Sat</div>
                    </div>

                    <div class="calendar-days" id="calendarDays">
                        <!-- Calendar days will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </aside>
    </main>

    <!-- Flash Messages -->
    @if(session('success'))
        <div id="flash-data" data-message="{{ session('success') }}"></div>
    @endif

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flash = document.querySelector('#flash-data');
            if (flash && flash.dataset.message) {
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3500,
                    icon: 'success',
                    title: flash.dataset.message
                });
            }

            // Theme Toggle Functionality
            const themeToggle = document.getElementById('themeToggle');
            const sunIcon = document.getElementById('sunIcon');
            const moonIcon = document.getElementById('moonIcon');
            const body = document.body;

            // Check for saved theme preference or default to light
            const currentTheme = localStorage.getItem('theme') || 'light';
            if (currentTheme === 'dark') {
                body.classList.add('dark');
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }

            themeToggle.addEventListener('click', function() {
                body.classList.toggle('dark');
                
                if (body.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                    sunIcon.classList.add('hidden');
                    moonIcon.classList.remove('hidden');
                } else {
                    localStorage.setItem('theme', 'light');
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                }
            });

            // Notification Button Functionality
            const notificationBtn = document.getElementById('notificationBtn');
            notificationBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Notifications',
                    html: `
                        <div class="text-left">
                            <div class="p-3 border-b border-gray-200 dark:border-gray-600">
                                <p class="font-medium">New payment received</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">From John Doe - $60.00</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">2 minutes ago</p>
                            </div>
                            <div class="p-3 border-b border-gray-200 dark:border-gray-600">
                                <p class="font-medium">New student registered</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Sarah Johnson joined</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">1 hour ago</p>
                            </div>
                            <div class="p-3">
                                <p class="font-medium">Event reminder</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Holiday: Founders Day tomorrow</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">3 hours ago</p>
                            </div>
                        </div>
                    `,
                    showConfirmButton: false,
                    showCloseButton: true,
                    width: 400
                });
            });

            // Profile Dropdown Functionality
            const profileBtn = document.getElementById('profileBtn');
            const profileMenu = document.getElementById('profileMenu');

            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                profileMenu.classList.toggle('show');
            });

            // Close profile dropdown when clicking outside
            document.addEventListener('click', function() {
                profileMenu.classList.remove('show');
            });

            // Prevent profile menu from closing when clicking inside it
            profileMenu.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            // Logout functionality - FIXED VERSION
            const logoutBtn = document.getElementById('logoutBtn');
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will be logged out of the system",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, logout!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create a form and submit it for POST request with CSRF token
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = "{{ route('superadmin.logout') }}";
                        
                        // Add CSRF token
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = "{{ csrf_token() }}";
                        form.appendChild(csrfToken);
                        
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });

            // Calendar functionality
            function generateCalendar(year, month) {
                const calendarDays = document.getElementById('calendarDays');
                calendarDays.innerHTML = '';

                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const today = new Date();
                
                // Get the day of the week for the first day (0 = Sunday, 1 = Monday, etc.)
                const firstDayOfWeek = firstDay.getDay();
                
                // Get the number of days in the month
                const daysInMonth = lastDay.getDate();
                
                // Get the number of days in the previous month
                const prevLastDay = new Date(year, month, 0).getDate();
                
                // Generate previous month's days
                for (let i = firstDayOfWeek - 1; i >= 0; i--) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day other-month';
                    dayElement.textContent = prevLastDay - i;
                    calendarDays.appendChild(dayElement);
                }
                
                // Generate current month's days
                for (let i = 1; i <= daysInMonth; i++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day current-month';
                    
                    // Check if this is today
                    if (year === today.getFullYear() && month === today.getMonth() && i === today.getDate()) {
                        dayElement.classList.add('today');
                    }
                    
                    // Randomly add events for demo (you can replace this with actual event data)
                    if (Math.random() > 0.7) {
                        dayElement.classList.add('has-event');
                    }
                    
                    dayElement.textContent = i;
                    calendarDays.appendChild(dayElement);
                }
                
                // Calculate how many next month days we need to show
                const totalCells = 42; // 6 rows * 7 days
                const nextMonthDays = totalCells - (firstDayOfWeek + daysInMonth);
                
                // Generate next month's days
                for (let i = 1; i <= nextMonthDays; i++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day other-month';
                    dayElement.textContent = i;
                    calendarDays.appendChild(dayElement);
                }
            }

            // Initialize calendar with current month
            const currentDate = new Date();
            generateCalendar(currentDate.getFullYear(), currentDate.getMonth());

            // Add navigation functionality
            let currentMonth = currentDate.getMonth();
            let currentYear = currentDate.getFullYear();

            document.querySelectorAll('.calendar-nav').forEach((button, index) => {
                button.addEventListener('click', function() {
                    if (index === 0) {
                        // Previous month
                        currentMonth--;
                        if (currentMonth < 0) {
                            currentMonth = 11;
                            currentYear--;
                        }
                    } else {
                        // Next month
                        currentMonth++;
                        if (currentMonth > 11) {
                            currentMonth = 0;
                            currentYear++;
                        }
                    }
                    
                    // Update calendar header
                    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                                       'July', 'August', 'September', 'October', 'November', 'December'];
                    document.querySelector('.calendar-header h3').textContent = 
                        `${monthNames[currentMonth]} ${currentYear}`;
                    
                    // Regenerate calendar
                    generateCalendar(currentYear, currentMonth);
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>