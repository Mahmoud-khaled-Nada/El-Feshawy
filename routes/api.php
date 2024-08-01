<?php

use App\Http\Controllers\AdminPanel\AboutUsController;
use App\Http\Controllers\AdminPanel\AppointmentAndContactReqController;
use App\Http\Controllers\AdminPanel\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanel\NewsController;
use App\Http\Controllers\AdminPanel\OurPeopleController;
use App\Http\Controllers\AdminPanel\PageController;
use App\Http\Controllers\AdminPanel\ServiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


require __DIR__.'/customer.php';
require __DIR__.'/lawyer.php';




Route::group(['prefix' => 'pages'], function () {
    Route::get('/', [PageController::class, 'pagesApi']);
    Route::get('news', [NewsController::class, 'newsApi']);
    Route::get('news/{id}', [NewsController::class, 'newsByIdApi']);
    Route::get('aboutUs', [AboutUsController::class, 'aboutUsApi']);
    Route::get('people', [OurPeopleController::class, 'peopleApi']);
    Route::get('person/{id}', [OurPeopleController::class, 'personApi']);
    Route::get('services', [ServiceController::class, 'servicesApi']);
    Route::get('contactUs', [ContactController::class, 'ContactUsApi']);
});


Route::post('contact-request-web', [AppointmentAndContactReqController::class, 'store']);