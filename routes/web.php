<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/department', [DepartmentController::class, 'index'])->name('departments');
    Route::get('/department/create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('/department', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('/department/{department:id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::put('/department/{department:id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::get('/department/{department:id}/show', [ DepartmentController::class, 'show'])->name('department.show');
    Route::delete('/department/{department}', [ DepartmentController::class, 'destroy'])->name('department.destroy');

    // Route::get('users', [UserController::class, 'index'])->name('users');
    // Route::get('/users/{user}/show', [UserController::class, 'show'])->name('users.show');
    // Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('/users', [UserController::class, 'store'])->name('users.store');
    // Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

});

require __DIR__.'/auth.php';
