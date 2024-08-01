<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Employees\AuthController;
use App\Http\Controllers\API\Employees\PasswordController;

use App\Http\Controllers\AdminPanel\ConversationController;
use App\Http\Controllers\AdminPanel\MeetingsController;
use App\Http\Controllers\AdminPanel\EventsController;
use App\Http\Controllers\AdminPanel\MessageController;
use App\Http\Controllers\AdminPanel\TaskController;



//TODOS  ************** lawyer **************
Route::group(['prefix' => 'lawyer'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forget/password', [PasswordController::class, 'forgetPassword']);
    Route::post('confirm/otp', [PasswordController::class, 'confirmOTP']);
    //TODOS  ************** lawyer **************
    Route::group(['middleware' => ['auth:employee', 'isActive:employee']], function () {
        Route::get('profile', [AuthController::class, 'profile']);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::post('fcm-token', [AuthController::class, 'updateFCMToken']);
        Route::post('update/profile', [AuthController::class, 'updateProfile']);
        Route::post('reset/password', [PasswordController::class, 'resetPassword']);
    });
    //TODOS  ************** Meeting **************
    Route::group(['middleware' => ['auth:employee', 'isActive:employee']], function () {
        //TODOS  ************** meetings **************
        Route::group(['prefix' => 'meetings'], function () {
            Route::get('/', [MeetingsController::class, 'employeeMeetings']);
            Route::get('meeting/{id}', [MeetingsController::class, 'employeeMeetingById']);
        });
        //TODOS  ************** Task **************
        Route::group(['middleware' => ['auth:employee', 'isActive:employee']], function () {
            Route::get('/tasks', [TaskController::class, 'getAuthEmployeeTasks']);
            Route::get('task/{id}', [TaskController::class, 'getTaskId']);
            // Route::post('create', [TaskController::class, 'store']);
            Route::get('task/{id}/change-status', [TaskController::class, 'changeTaskStatus'])->middleware('throttle:2,1');
            Route::get('task/{task}/checklist-item/{checklistItem}/change-status', 
            [TaskController::class, 'changeChecklistItemStatus'])->middleware('throttle:4,1');
            Route::post('/task/upload-file/{id}', [TaskController::class, 'uploadFile']);
        });

        //TODOS ** EventsApi **
        Route::get('/get-events', [EventsController::class, 'EventsApi']);

        //TODOS ** supporter **
        Route::group(['prefix' => 'supporter'], function () {
            // Route::get('conversations', [ConversationController::class, 'apiIndex']);
            Route::post('conversation', [ConversationController::class, 'apiStore']);
            Route::get('conversation/{id}', [ConversationController::class, 'apiShow']);
            Route::post('messages', [MessageController::class, 'apiStore']);
        });
    });
});
