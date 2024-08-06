<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\ManageUsersController;
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
    // Route::get('/user/{user}/clients', [UserController::class, 'clients'])->name('api.user.clients');
    // Route::get('/users', [UserController::class, 'users'])->name('api.users');
    // Route::get('/assignees', [UserController::class, 'index'])->name('api.users.index');
    // Route::post('/users', [UserController::class, 'store'])->name('api.users.store');
    // Route::patch('/users/{user}', [UserController::class, 'update'])->name('api.users.update');
    // Route::post('/users/{user}/reset-password', [UserController::class, 'resetPasswordUser'])->name('api.user.password.reset');
    // Route::get('/users/{user}/subscriptions', [UserController::class, 'getSubscriptions'])->name('api.user.subscriptions');


    Route::post('departments', [DepartmentController::class, 'store'])->name('api.department.store');
    Route::get('department/{department}', [DepartmentController::class, 'show'])->name('api.department.show');
    Route::put('department/{department}', [DepartmentController::class, 'update'])->name('api.department.update');
    Route::get('departments', [DepartmentController::class, 'getDepartments'])->name('api.department.list');
    Route::delete('department/{department}', [DepartmentController::class, 'destroy'])->name('api.department.destroy');
});