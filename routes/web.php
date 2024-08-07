<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\ParentMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

    //student
    Route::get('admin/student/list', [StudentController::class,'list']);
    Route::get('admin/student/add', [StudentController::class,'add']);
    Route::post('admin/student/add', [StudentController::class,'insert']);
    Route::get('/admin/student/edit/{id}', [StudentController::class,'edit']);
    Route::post('/admin/student/edit/{id}', [StudentController::class,'update']);
    Route::get('/admin/student/delete/{id}', [StudentController::class,'delete']);

    //teacher
    Route::get('admin/teacher/list', [TeacherController::class,'list']);
    Route::get('admin/teacher/add', [TeacherController::class,'add']);
    Route::post('admin/teacher/add', [TeacherController::class,'insert']);
    Route::get('/admin/teacher/edit/{id}', [TeacherController::class,'edit']);
    Route::post('/admin/teacher/edit/{id}', [TeacherController::class,'update']);
    Route::get('/admin/teacher/delete/{id}', [TeacherController::class,'delete']);

    //parent
    Route::get('admin/parent/list', [ParentController::class,'list']);
    Route::get('admin/parent/add', [ParentController::class,'add']);
    Route::post('admin/parent/add', [ParentController::class,'insert']);
    Route::get('/admin/parent/edit/{id}', [ParentController::class,'edit']);
    Route::post('/admin/parent/edit/{id}', [ParentController::class,'update']);
    Route::get('/admin/parent/delete/{id}', [ParentController::class,'delete']);
    Route::get('/admin/parent/my-student/{id}', [ParentController::class,'myStudent']);
    Route::get('/admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class,'AssignStudentParent']);
    Route::get('/admin/parent/assign_student_parent_delete/{id}', [ParentController::class,'AssignStudentParentDelete']);

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

    //assign_class_teacher url
    Route::get('/admin/assign_class_teacher/list', [AssignClassTeacherController::class,'list']);
    Route::get('/admin/assign_class_teacher/add', [AssignClassTeacherController::class,'add']);
    Route::post('/admin/assign_class_teacher/add', [AssignClassTeacherController::class,'insert']);
    Route::get('/admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class,'edit']);
    Route::post('/admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class,'update']);
    Route::get('/admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class,'edit_single']);
    Route::post('/admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class,'update_single']);
    Route::get('/admin/assign_class_teacher/delete/{id}', [AssignClassTeacherController::class,'delete']);

    //change password
    Route::get('/admin/change_password', [UserController::class,'change_password']);
    Route::post('/admin/change_password', [UserController::class,'update_change_password']);

    //Update Profile
    Route::get('/admin/account', [UserController::class,'MyAccount']);
    Route::post('/admin/account', [UserController::class,'UpdateAccountAdmin']);
}); 

Route::group(['middleware' => StudentMiddleware::class], function () {

    Route::get('/student/dashboard',[DashboardController::class,'dashboard']);

     //change password
    Route::get('/student/change_password', [UserController::class,'change_password']);
    Route::post('/student/change_password', [UserController::class,'update_change_password']);

    //Update Profile
    Route::get('/student/account', [UserController::class,'MyAccount']);
    Route::post('/student/account', [UserController::class,'UpdateAccountStudent']);

    Route::get('/student/mysubjects', [SubjectController::class,'MySubjects']);

});

Route::group(['middleware' => ParentMiddleware::class], function () {

    Route::get('/parent/dashboard',[DashboardController::class,'dashboard']);

     //change password
    Route::get('/parent/change_password', [UserController::class,'change_password']);
    Route::post('/parent/change_password', [UserController::class,'update_change_password']);

    //Update Profile
    Route::get('/parent/account', [UserController::class,'MyAccount']);
    Route::post('/parent/account', [UserController::class,'UpdateAccountParent']);

    Route::get('/parent/mystudent', [ParentController::class,'my_student']);
    Route::get('/parent/mystudentsubject/{id}', [SubjectController::class,'my_studentsubject']);

});

Route::group(['middleware' => TeacherMiddleware::class], function () {
    
    Route::get('/teacher/dashboard',[DashboardController::class,'dashboard']);

    //change password
    Route::get('/teacher/change_password', [UserController::class,'change_password']);
    Route::post('/teacher/change_password', [UserController::class,'update_change_password']);

     //Update Profile
    Route::get('/teacher/account', [UserController::class,'MyAccount']);
    Route::post('/teacher/account', [UserController::class,'UpdateAccountTeacher']);
});