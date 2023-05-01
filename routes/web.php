<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\GallaryPhotosController as AdminGallaryPhotosController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Portal\PortalController as PortalLoginController;
use App\Http\Controllers\Portal\JobController as JobController;
use App\Http\Controllers\Portal\ServiceController as ServiceController;

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

        Route::get('/users/list',[AdminUserController::class,'getUsers'])->name('admin.users.list');

        Route::get('/gallary/list',[AdminGallaryPhotosController::class,'getGallaryPhotos'])->name('admin.gallary.list');
        Route::get('/gallary/add', function () {
            return view('admin.gallary.add');
        });
        Route::post('/gallary/add',[AdminGallaryPhotosController::class,'gallaryPhotoAdd'])->name('admin.gallary.add');
        Route::get('/gallary/edit/{id}',[AdminGallaryPhotosController::class,'getEditGallaryPhoto']);
        Route::post('/gallary/edit/{id}',[AdminGallaryPhotosController::class,'editGallaryPhoto']);
        Route::get('/gallary/delete/{id}',[AdminGallaryPhotosController::class,'deleteGallaryPhoto']);

        Route::get('/products/list',[AdminProductController::class,'getProductPhotos'])->name('admin.products.list');
        Route::get('/products/add', function () {
            return view('admin.products.add');
        });
        Route::post('/products/add',[AdminProductController::class,'productAdd'])->name('admin.products.add');
        Route::get('/products/edit/{id}',[AdminProductController::class,'getEditProducts']);
        Route::post('/products/edit/{id}',[AdminProductController::class,'editProduct'])->name('admin.products.edit');
        Route::get('/products/delete/{id}',[AdminProductController::class,'deleteProducts']);

        Route::get('/news/list',[AdminProductController::class,'getProductPhotos'])->name('admin.news.list');

        Route::get('/courses/list',[AdminCourseController::class,'getCourses'])->name('admin.courses.list');
        Route::get('/courses/add', function () {
            return view('admin.courses.add');
        });
        Route::post('/courses/add',[AdminCourseController::class,'CourseAdd'])->name('admin.courses.add');
        Route::get('/courses/edit/{id}',[AdminCourseController::class,'getEditCourse']);
        Route::post('/courses/edit/{id}',[AdminCourseController::class,'editCourse']);
        
        Route::get('/logout',[AdminAuthController::class,'logout'])->name('admin.logout');
    });
});

/******** Portal Routes ************/
Route::get('/', function () {
    return redirect('home');
});

Route::get('/home',[PortalLoginController::class,'home'])->name('portal.home');

Route::get('login', function () {
    return view('portal.login');
});

Route::controller(PortalLoginController::class)->group(function() {
    Route::post('/register', 'register')->name('register');

    Route::post('/login', 'userLogin')->name('login');
});
Route::post('/createjob',[JobController::class,'createJob'])->name('createjob');

Route::get('/job',[JobController::class,'viewJob'])->name('portal.job');

Route::get('/myaccount',[PortalLoginController::class,'myAcnt'])->name('portal.profile');

Route::get('/course',[PortalLoginController::class,'courses'])->name('portal.course');

Route::get('/logout',[PortalLoginController::class,'logout']);

Route::get('/post/job', function () {
    return view('portal.postjob');
});

Route::get('/job/applyjob/{id}',[JobController::class,'applyJob']);

// service routes

Route::get('/service/events',[ServiceController::class,'getEvent'])->name('portal.events');

Route::get('/service/course',[ServiceController::class,'getCourse'])->name('portal.course');

Route::get('/service/news',[ServiceController::class,'getNews'])->name('portal.news');

Route::get('/course/addtocart/{id}',[ServiceController::class,'addToCart']);

Route::get('/cart',[ServiceController::class,'getCart']);

Route::get('/cart/deletecart/{id}',[ServiceController::class,'deleteCart']);

Route::post('/updateProfile',[PortalLoginController::class,'updateProfile'])->name('updateProfile');

Route::get('/contact', function () {
    return view('portal.contact');
});

Route::get('/service/webinar', function () {
    return view('portal.services.webinar');
});

Route::get('/service/blog', function () {
    return view('portal.services.blog');
});