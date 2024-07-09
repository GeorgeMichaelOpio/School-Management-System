<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\AdminController;
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


Route::group(['middleware' => AdminMiddleware::class], function () {

    Route::get('/admin/dashboard',[DashboardController::class,'dashboard']);
    Route::get('/admin/list', [AdminController::class,'list']);
    Route::get('/admin/add', [AdminController::class,'add']);
    Route::post('/admin/add', [AdminController::class,'insert']);
    Route::get('/admin/edit/{id}', [AdminController::class,'edit']);
    Route::post('/admin/edit/{id}', [AdminController::class,'update']);
    Route::get('/admin/delete/{id}', [AdminController::class,'delete']);

    //Class Url
    Route::get('/admin/class/list', [ClassController::class,'list']);
    Route::get('/admin/class/add', [ClassController::class,'add']);
    Route::post('/admin/class/add', [ClassController::class,'insert']);
    Route::get('/admin/class/edit/{id}', [ClassController::class,'edit']);
    Route::post('/admin/class/edit/{id}', [ClassController::class,'update']);
    Route::get('/admin/class/delete/{id}', [ClassController::class,'delete']);

    //Subject Url
    Route::get('/admin/subject/list', [SubjectController::class,'list']);
    Route::get('/admin/subject/add', [SubjectController::class,'add']);
    Route::post('/admin/subject/add', [SubjectController::class,'insert']);
    Route::get('/admin/subject/edit/{id}', [SubjectController::class,'edit']);
    Route::post('/admin/subject/edit/{id}', [SubjectController::class,'update']);
    Route::get('/admin/subject/delete/{id}', [SubjectController::class,'delete']);

    //assign_subject url
    Route::get('/admin/assign_subject/list', [ClassSubjectController::class,'list']);
    Route::get('/admin/assign_subject/add', [ClassSubjectController::class,'add']);
    Route::post('/admin/assign_subject/add', [ClassSubjectController::class,'insert']);
    Route::get('/admin/assign_subject/edit/{id}', [ClassSubjectController::class,'edit']);
    Route::post('/admin/assign_subject/edit/{id}', [ClassSubjectController::class,'update']);
    Route::get('/admin/assign_subject/edit_single/{id}', [ClassSubjectController::class,'edit_single']);
    Route::post('/admin/assign_subject/edit_single/{id}', [ClassSubjectController::class,'update_single']);
    Route::get('/admin/assign_subject/delete/{id}', [ClassSubjectController::class,'delete']);


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