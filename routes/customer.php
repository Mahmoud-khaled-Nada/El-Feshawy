<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Customer\Auth\AuthController as CustomerAuthController;
use App\Http\Controllers\API\Customer\Auth\AvatarController;
use App\Http\Controllers\API\Customer\Auth\PasswordManagement;
use App\Http\Controllers\AdminPanel\InquirieController;
use App\Http\Controllers\AdminPanel\MeetingsController;

Route::group(['prefix' => 'customer'], function () {
    Route::post('register', [CustomerAuthController::class, 'register']);
    Route::post('login', [CustomerAuthController::class, 'login']);
    Route::post('forgot-password', [PasswordManagement::class, 'ForgotPassword']);
    Route::post('confirmation-code', [PasswordManagement::class, 'verifyOTP']);
    Route::post('new-password/{email}', [PasswordManagement::class, 'resetPassword']);
    //================================================>
    Route::group(['middleware' => 'auth:customer'], function () {
        Route::post('logout', [CustomerAuthController::class, 'logout']);
        Route::post('refresh', [CustomerAuthController::class, 'refresh']);
        Route::get('profile', [CustomerAuthController::class, 'profile']);
        Route::post('add-avatar', [AvatarController::class, 'addAvatar']);

        //================================================>
        Route::post('/send-inquirie', [InquirieController::class, 'store']);

        //================================================>

        Route::get('/meetings', [MeetingsController::class, 'getMeetingsForCustomer']);
        Route::get('/meeting/{id}', [MeetingsController::class, 'customerMeetingById']);

        //================================================>
    });
});
