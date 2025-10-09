<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('/students',StudentController::class);
Route::resource('/teachers', TeacherController::class);
Route::resource('/courses', CourseController::class);
Route::get('/enrollment', [EnrollmentController::class, 'index'])->name('enrollment.index');
Route::get('/enrollment/create', [EnrollmentController::class, 'create'])->name('enrollment.create');
Route::post('/enrollment', [EnrollmentController::class, 'store'])->name('enrollment.store');
Route::resource('/payments', PaymentController::class)->only(['index','create','store']);