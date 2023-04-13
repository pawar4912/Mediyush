<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\EventController as AdminEventController;

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
Route::prefix('admin')->group(function () {
    Route::get('login', function () {
        return view('admin.login');
    });

    Route::post('login',[AdminAuthController::class,'adminLogin'])->name('admin.login');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        });
        Route::get('/jobs/list',[AdminJobController::class,'getJobs'])->name('admin.jobs.list');
        Route::get('/jobs/activate/{id}',[AdminJobController::class,'jobActivate'])->name('admin.jobs.activate');
        Route::get('/jobs/deactivate/{id}',[AdminJobController::class,'jobDeactivate'])->name('admin.jobs.deactivate');
        Route::post('/jobs/edit/{id}',[AdminJobController::class,'jobEdit'])->name('admin.jobs.edit');

        Route::get('/events/list',[AdminEventController::class,'getEvents'])->name('admin.events.list');
        Route::get('/events/add', function () {
            return view('admin.events.add');
        });
        Route::post('/events/add',[AdminEventController::class,'eventAdd'])->name('admin.events.add');
        Route::get('/events/edit/{id}',[AdminEventController::class,'getEditEvent']);
        Route::post('/events/edit/{id}',[AdminEventController::class,'editEvent'])->name('admin.events.edit');
        Route::get('/events/activate/{id}',[AdminEventController::class,'eventActivate']);
        Route::get('/events/deactivate/{id}',[AdminEventController::class,'eventDeactivate']);

        Route::get('/logout',[AdminAuthController::class,'logout'])->name('admin.logout');
    });
});
