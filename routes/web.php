<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\User\DashboardController as UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[AuthController::class,'login'])->name('login');
Route::post('/check-login',[AuthController::class,'checkLogin'])->name('check-login');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'storeRegister'])->name('store-register');
Route::get('/logout',[AuthController::class,'logout'])->name('logout')->middleware('auth');
Route::get('/forget-password',[AuthController::class,'forgetPassword']);
Route::post('/send-reset-link',[AuthController::class,'sendResetLink']);
Route::post('/store-reset-password',[AuthController::class,'storeResetPassword']);

Route::group(['prefix'=>'admin','middleware'=>['auth','checkAdmin']],function(){
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::post('/store-category',[DashboardController::class,'storeCategory'])->name('store-category');
    Route::get('/add-calendar',[DashboardController::class,'addCalendar'])->name('add-calendar');
    Route::post('/store-calendar',[DashboardController::class,'storeCalendar'])->name('store-calendar');
    Route::get('/monthly-calendar',[DashboardController::class,'monthlyCalendar'])->name('monthly-calendar');
    Route::post('/store-calendar-event',[DashboardController::class,'storeCalendarEvent'])->name('store-calendar-event');
    Route::get('/edit-calendar-event',[DashboardController::class,'editCalendarEvent']);
    Route::post('/update-calendar-event',[DashboardController::class,'updateCalendarEvent']);
    Route::post('/get-calendar-month-data',[DashboardController::class,'getCalendarMonthData']);
    Route::get('/three-monthly-calendar',[DashboardController::class,'threeMonthlyCalendar'])->name('three-monthly-calendar');
    Route::post('/get-calendar-three-month-data',[DashboardController::class,'getCalendarThreeMonthData']);
    Route::any('/yearly-calendar',[DashboardController::class,'yearlyCalendar'])->name('yearly-calendar');
    Route::get('/enquiries',[DashboardController::class,'enquiries'])->name('enquiries');
    Route::get('/remove-enquiry',[DashboardController::class,'removeEnquiry'])->name('remove-enquiry');
    Route::get('/all-categories',[CategoryController::class,'allCategories']);
    Route::post('/update-category',[CategoryController::class,'updateCategory']);
    Route::get('/remove-category',[CategoryController::class,'removeCategory']);
    Route::get('/all-users',[CategoryController::class,'allUsers']);
    Route::get('/add-user',[CategoryController::class,'addUser']);
    Route::get('/remove-user',[CategoryController::class,'removeUser']);
    Route::get('/edit-calendar',[CategoryController::class,'editCalendar']);
    Route::post('/update-calendar',[CategoryController::class,'updateCalendar']);
});

Route::group(['prefix'=>'user','middleware'=>['auth']],function(){
    Route::get('/dashboard',[UserController::class,'dashboard'])->name('u-dashboard');
    Route::get('/monthly-calendar',[UserController::class,'monthlyCalendar'])->name('u-monthly-calendar');
    Route::post('/get-calendar-month-data',[UserController::class,'getCalendarMonthData']);
    Route::get('/three-monthly-calendar',[UserController::class,'threeMonthlyCalendar'])->name('u-three-monthly-calendar');
    Route::post('/get-calendar-three-month-data',[UserController::class,'getCalendarThreeMonthData']);
    Route::any('/yearly-calendar',[UserController::class,'yearlyCalendar'])->name('u-yearly-calendar');
});


Route::get('privacy-policy',[IndexController::class,'privacyPolicy']);
Route::get('terms-and-condition',[IndexController::class,'termsAndCondition']);
Route::get('contact-us',[IndexController::class,'contactUs']);
Route::post('store-contact',[IndexController::class,'storeContact']);
Route::get('reset-password',[AuthController::class,'resetPassword']);

Route::group(['middleware'=>['auth']],function(){
Route::get('my-profile',[IndexController::class,'myProfile']);
Route::post('update-profile',[IndexController::class,'updateProfile']);
Route::post('update-password',[IndexController::class,'updatePassword']);
});