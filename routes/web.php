<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\JobController;

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

    Route::post('login',[AuthController::class,'adminLogin'])->name('admin.login');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        });
        Route::get('/jobs/list',[JobController::class,'getJobs'])->name('admin.jobs.list');
        Route::get('/jobs/activate/{id}',[JobController::class,'jobActivate'])->name('admin.jobs.activate');
        Route::get('/jobs/deactivate/{id}',[JobController::class,'jobDeactivate'])->name('admin.jobs.deactivate');
        Route::post('/jobs/edit/{id}',[JobController::class,'jobEdit'])->name('admin.jobs.edit');
        Route::get('/logout',[AuthController::class,'logout'])->name('admin.logout');
    });
});