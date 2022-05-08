<?php

use App\Http\Controllers\API\Device\AuthController;
use App\Http\Controllers\API\Device\FileUploadController;
use App\Http\Controllers\API\Device\PushNotificationController;
use App\Http\Controllers\API\Device\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum', 'validate.user']], function () {
    Route::post('users', [UserController::class, 'store'])
        ->name('user.store')
        ->middleware(['permission:create_user']);
    Route::get('users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware(['permission:read_user']);
    Route::get('users/{user}', [UserController::class, 'show'])
        ->name('user.show')
        ->middleware(['permission:read_user']);
    Route::put('users/{user}', [UserController::class, 'update'])
        ->name('user.update')
        ->middleware(['permission:update_user']);
    Route::delete('users/{user}', [UserController::class, 'delete'])
        ->name('user.delete')
        ->middleware(['permission:delete_user']);
    Route::post('users/bulk-create', [UserController::class, 'bulkStore'])
        ->name('user.store.bulk')
        ->middleware(['permission:create_user']);
    Route::post('users/bulk-update', [UserController::class, 'bulkUpdate'])
        ->name('user.update.bulk')
        ->middleware(['permission:update_user']);
});

Route::post('file-upload', [FileUploadController::class, 'upload'])
    ->name('file.upload');

Route::post('push-notifications/add-device-id', [PushNotificationController::class, 'store'])
    ->name('pushNotification.add-device');
Route::post('push-notifications/remove-device-id', [PushNotificationController::class, 'removeDeviceId'])
    ->name('pushNotification.remove-device');

Route::post('register', [AuthController::class, 'register'])
    ->name('register');
Route::post('login', [AuthController::class, 'login'])
    ->name('login');
Route::post('logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth:sanctum');
Route::put('change-password', [AuthController::class, 'changePassword'])
    ->name('change.password')
    ->middleware(['auth:sanctum', 'validate.user']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('forgot.password');
Route::post('validate-otp', [AuthController::class, 'validateResetPasswordOtp'])
    ->name('reset.password.validate.otp');
Route::put('reset-password', [AuthController::class, 'resetPassword'])
    ->name('reset.password');
