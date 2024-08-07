<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ExtensionController;
use App\Http\Controllers\Api\DepartmentController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('users', [UserController::class, 'getUsers'])->name('api.user.list');
    Route::post('/user', [UserController::class, 'store'])->name('api.user.store');
    Route::get('user/{user}', [UserController::class, 'show'])->name('api.user.show');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('api.user.update');

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