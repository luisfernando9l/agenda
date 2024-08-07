<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\DepartmentController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    Route::get('/department/create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('/department', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('/department/{department:id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::put('/department/{department:id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::get('/department/{department:id}/show', [DepartmentController::class, 'show'])->name('department.show');
    Route::delete('/department/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');

    Route::get('/extensions', [ExtensionController::class, 'index'])->name('extensions');
    Route::get('/extension/create', [ExtensionController::class, 'create'])->name('extension.create');
    Route::post('/extension', [ExtensionController::class, 'store'])->name('extension.store');
    Route::get('/extension/{extension:id}/edit', [ExtensionController::class, 'edit'])->name('extension.edit');
    Route::put('/extension/{extension:id}', [ExtensionController::class, 'update'])->name('extension.update');
    Route::get('/extension/{extension:id}/show', [ExtensionController::class, 'show'])->name('extension.show');
    Route::delete('/extension/{extension}', [ExtensionController::class, 'destroy'])->name('extension.destroy');

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('/users/{user}/show', [UserController::class, 'show'])->name('user.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});

require __DIR__.'/auth.php';
