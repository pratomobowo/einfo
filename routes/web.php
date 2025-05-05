<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TvDisplayController;
use App\Http\Controllers\Admin\DecreeController;
use App\Http\Controllers\Admin\DecreeCategoryController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TvDisplayController::class, 'index'])->name('home');
Route::get('/activities-legacy', [ActivityController::class, 'index'])->name('activities.legacy');
Route::get('/tv', [TvDisplayController::class, 'index'])->name('tv.index');

// Public routes
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');
Route::get('/activities/{activity}/download-assignment-letter', [ActivityController::class, 'downloadAssignmentLetter'])->name('activities.download_assignment_letter');

// Admin routes
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/activities', [AdminController::class, 'activities'])->name('activities');
    Route::get('/officials', [AdminController::class, 'officials'])->name('officials');
    Route::get('/documentation', [AdminController::class, 'documentation'])->name('documentation');
    
    // User management routes
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::resource('users', UserController::class)->except(['index']);
    
    // Activity Logs routes
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity_logs.index');
    Route::get('/activity-logs/{activityLog}', [ActivityLogController::class, 'show'])->name('activity_logs.show');
    
    // Tambah routes untuk activities yang menggunakan layout admin
    Route::get('/activities/create', [AdminController::class, 'createActivity'])->name('activities.create');
    Route::get('/activities/{activity}/edit', [AdminController::class, 'editActivity'])->name('activities.edit');
    
    // Route untuk menghapus file surat tugas
    Route::get('/activities/{activity}/delete-file', [ActivityController::class, 'deleteAssignmentFile'])->name('activities.delete_file');
    
    Route::resource('activities', ActivityController::class)->except(['index', 'show', 'create', 'edit']);
    
    // Resource route untuk officials
    Route::resource('officials', OfficialController::class)->except(['index']);
    
    // Resource route untuk decrees (SK)
    Route::resource('decrees', DecreeController::class);
    
    // Resource route untuk decree categories (Kategori SK)
    Route::resource('decree-categories', DecreeCategoryController::class);
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
