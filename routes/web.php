<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/logi', [AuthController::class, 'index'])->name('logi');

Route::middleware('auth')->group(function () {

    // Route::get('users', [UserController::class, 'index'])->name('users');
    // Route::get('/users/{user}/show', [UserController::class, 'show'])->name('users.show');
    // Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('/users', [UserController::class, 'store'])->name('users.store');
    // Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

});

require __DIR__.'/auth.php';