<?php

use App\Http\Controllers\AdminPanel\AboutUsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// 

use App\Http\Controllers\AdminPanel\AdminController;
use App\Http\Controllers\AdminPanel\AppointmentAndContactReqController;
use App\Http\Controllers\AdminPanel\AuthController;
use App\Http\Controllers\AdminPanel\ContactController;
use App\Http\Controllers\AdminPanel\ConversationController;
use App\Http\Controllers\AdminPanel\CustomerController;
use App\Http\Controllers\AdminPanel\EmployeeController;
use App\Http\Controllers\AdminPanel\EventsController;
use App\Http\Controllers\AdminPanel\InquirieController;
use App\Http\Controllers\AdminPanel\MeetingsController;
use App\Http\Controllers\AdminPanel\MessageController;
use App\Http\Controllers\AdminPanel\NewsController;
use App\Http\Controllers\AdminPanel\OnboardingController;
use App\Http\Controllers\AdminPanel\OurPeopleController;
use App\Http\Controllers\AdminPanel\PageController;
use App\Http\Controllers\AdminPanel\PagesContentController;
use App\Http\Controllers\AdminPanel\RoleController;
use App\Http\Controllers\AdminPanel\ServiceController;
use App\Http\Controllers\AdminPanel\TaskController;
use App\Models\Conversation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*
|--------------------------------------------------------------------------
| Check server status
|--------------------------------------------------------------------------
*/


Route::get('/up', function () {
    return response()->json(['status' => 'Yes server is running 👍']);
});





Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::middleware(['guest'])->group(function () {
            Route::get('/', [AuthController::class, 'login'])->name('auth.login');
            Route::get('/login', [AuthController::class, 'postLogin'])->name('post.login');
        });
        //TODOS ** dashboard **
        Route::middleware('auth:web')->group(function () {
            Route::get('/dashboard', function () {
                return view('welcome');
            })->name('dashboard');

            Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
            //TODOS ** isSuperAdmin **
            Route::middleware('isSuperAdmin')->group(function () {
                Route::get('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');
                Route::resource('admins', AdminController::class)->except('destroy');
                Route::get('/role/delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
                Route::resource('role', RoleController::class)->except('destroy');
            });
            //TODOS ** pages **
            Route::resource('pages', PageController::class)->except(['destroy', 'show', 'create', 'store']);
            //TODOS ** news **
            Route::get('/news/delete/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
            Route::resource('news', NewsController::class)->except(['destroy', 'show']);

            //TODOS ** aboutus **
            Route::get('/aboutus/delete/{id}', [AboutUsController::class, 'destroy'])->name('aboutus.destroy');
            Route::resource('aboutus', AboutUsController::class)->except(['destroy', 'show']);

            //TODOS ** ourPeople **
            Route::get('/people/delete/{id}', [OurPeopleController::class, 'destroy'])->name('people.destroy');
            Route::resource('people', OurPeopleController::class)->except(['destroy', 'show']);

            //TODOS ** services **
            Route::get('/service/delete/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
            Route::resource('services', ServiceController::class)->except(['destroy', 'show']);

            //TODOS ** contactus **
            Route::get('/contact/delete/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
            Route::resource('contact', ContactController::class)->except(['destroy', 'show']);

            //TODOS ** appointmentReq and contactUsReq from web app **
            Route::get('/appointmentReq', [AppointmentAndContactReqController::class, 'indexAppointment'])->name('appointmentReq.index');
            Route::get('/contactUsReq', [AppointmentAndContactReqController::class, 'indexContactUs'])->name('contactUsReq.index');
            Route::get('/download-file/{filename}', [AppointmentAndContactReqController::class, 'downloadFile'])->name('appointmentReq.download');
            Route::get('/appointmentReq/{id}', [AppointmentAndContactReqController::class, 'destroyAppointment'])->name('appointmentReq.destroy');
            Route::get('/contactUsReq/{id}', [AppointmentAndContactReqController::class, 'destroyContactUs'])->name('contactUsReq.destroy');

            
            //TODOS ** employee **
            Route::get('/employee/import', [EmployeeController::class, 'import'])->name('employees.import');
            Route::post('/employee/import/save', [EmployeeController::class, 'importSave'])->name('employees.import.save');
            Route::get('/employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
            Route::resource('employees', EmployeeController::class)->except(['destroy', 'show']);
            //TODOS ** events **
            Route::resource('events', EventsController::class)->except('destroy');
            Route::get('/events/delete/{id}', [EventsController::class, 'destroy'])->name('events.destroy');
            //TODOS ** customers **
            Route::resource('customers', CustomerController::class)->except('destroy');
            Route::get('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
            //events.index
            //TODOS ** tasks **
            Route::group(['prefix' => 'tasks'], function () {
                Route::get('/', [TaskController::class, 'index'])->name('task.index');
                Route::get('/create', [TaskController::class, 'create'])->name('task.create');
                Route::post('/create', [TaskController::class, 'store'])->name('task.store');
                Route::get('/delete/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
                Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
                Route::put('/update/{id}', [TaskController::class, 'update'])->name('task.update');
                Route::get('/download/{filename}', [TaskController::class, 'downloadFile'])->name('task.download');
            });
            //TODOS ** meetings **
            Route::resource('meetings',  MeetingsController::class)->except('destroy');
            Route::get('/meeting/{id}/delete', [MeetingsController::class, 'destroy'])->name('meetings.destroy');
            //TODOS ** inquiries **
            Route::group(['prefix' => 'inquiries'], function () {
                Route::get('/', [InquirieController::class, 'index'])->name('inquiries.index');
                Route::get('/create/{customerId}', [InquirieController::class, 'create'])->name('inquiries.create');
                Route::get('/delete/{id}', [InquirieController::class, 'destroy'])->name('inquiries.destroy');
            });
            //TODOS ** supporter **
            Route::group(['prefix' => 'supporter'], function () {
                Route::get('conversations', [ConversationController::class, 'index'])->name('conversations.index');
                Route::get('conversation/{id}', [ConversationController::class, 'show'])->name('conversation.show');
                // Route::post('conversation', [ConversationController::class, 'store']);
                Route::post('messages', [MessageController::class, 'store'])->name('conversation.store');
            });
        });
    }
);
