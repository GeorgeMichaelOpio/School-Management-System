<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\ParentMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//);

Route::get('/',[AuthController::class,'login']);

Route::post('login',[AuthController::class,'Authlogin']);

Route::get('logout',[AuthController::class,'logout']);

Route::get('forgot-password',[AuthController::class,'forgotpassword']);

Route::post('forgot-password',[AuthController::class,'PostForgotPassword']);

Route::get('reset/{token}',[AuthController::class,'reset']);

Route::post('reset/{token}',[AuthController::class,'PostReset']);



Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/list', function () {
    return view('admin.admin.list');
});



Route::group(['middleware' => AdminMiddleware::class], function () {

    Route::get('/admin/dashboard',[DashboardController::class,'dashboard']);
    
});

Route::group(['middleware' => StudentMiddleware::class], function () {

    Route::get('/student/dashboard',[DashboardController::class,'dashboard']);

});

Route::group(['middleware' => ParentMiddleware::class], function () {

    Route::get('/parent/dashboard',[DashboardController::class,'dashboard']);

});

Route::group(['middleware' => TeacherMiddleware::class], function () {
    
        Route::get('/teacher/dashboard',[DashboardController::class,'dashboard']);

});