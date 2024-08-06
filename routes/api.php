<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\Api\ExtensionController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\ResetPasswordController;

Route::prefix('auth')->group(function () {
    Route::post('/users', [ManageUsersController::class, 'store']);
    Route::post('/login', [ManageUsersController::class, 'login']);
    Route::post('/forgot-password', [ResetPasswordController::class, 'forgotPassword']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::get('/users/{user}', [UserController::class, 'info'])->name('api.users.show');
    // Route::put('/users/{user}', [UserController::class, 'updateProfile'])->name('api.users.profile');
    // Route::get('/user/{user}/properties', [UserController::class, 'properties'])->name('api.user.properties');
    // Route::get('/users', [UserController::class, 'users'])->name('api.users');
    // Route::get('/assignees', [UserController::class, 'index'])->name('api.users.index');
    // Route::post('/users', [UserController::class, 'store'])->name('api.users.store');
    // Route::patch('/users/{user}', [UserController::class, 'update'])->name('api.users.update');

    Route::post('departments', [DepartmentController::class, 'store'])->name('api.department.store');
    Route::get('department/{department}', [DepartmentController::class, 'show'])->name('api.department.show');
    Route::put('department/{department}', [DepartmentController::class, 'update'])->name('api.department.update');
    Route::get('departments', [DepartmentController::class, 'getDepartments'])->name('api.department.list');
    Route::delete('department/{department}', [DepartmentController::class, 'destroy'])->name('api.department.destroy');

    Route::post('extensions', [ExtensionController::class, 'store'])->name('api.extensions.store');
    Route::get('extensions/{department}', [ExtensionController::class, 'show'])->name('api.extensions.show');
    Route::put('extensions/{department}', [ExtensionController::class, 'update'])->name('api.extensions.update');
    Route::get('extensions', [ExtensionController::class, 'getExtensions'])->name('api.extensions.list');
    Route::delete('extensions/{department}', [ExtensionController::class, 'destroy'])->name('api.extensions.destroy');
});