<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\AdminProtected;
use App\Http\Middleware\TeacherProtected;
use App\Http\Middleware\StudentProtected;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index']);
Route::get('/programs', [HomeController::class,'programpage']);

Route::get('/faculties', [HomeController::class,'facultypage']);
Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/auth/check', [AuthController::class,'index']);
Route::group(['middleware'=>['AdminProtected']],function(){
	Route::get('/admin/dashboard', [AdminController::class,'index']);
   Route::get('/admin/students', [AdminController::class,'view_students']);
   Route::post('/admin/student/add', [AdminController::class,'add_student']);
   Route::post('/admin/teacher/add', [AdminController::class,'add_teacher']);
 Route::get('/admin/teachers', [AdminController::class,'view_teachers']);
 Route::get('/admin/classes', [AdminController::class,'view_classes']);
 Route::post('/admin/class/add', [AdminController::class,'add_class']);
 Route::post('/admin/class/edit', [AdminController::class,'edit_class']);
 Route::post('/admin/course/add', [AdminController::class,'add_course']);
 Route::post('/admin/course/edit', [AdminController::class,'edit_course']);
 Route::get('/admin/course/delete/{subjectid}/{classid}', [AdminController::class,'delete_course']);
 Route::post('/admin/user/edit', [AdminController::class,'edit_user']);
 Route::get('/admin/result', [AdminController::class,'view_result']);
 Route::post('/admin/result', [AdminController::class,'view_conducted_exams']);
 Route::get('/admin/result/display/{c_exam_id}', [AdminController::class,'display_result']);
 Route::get('/admin/subjects/{class_id}', [AdminController::class,'get_subjects_by_class']);
 Route::get('/admin/student/detail/{std_id}', [AdminController::class,'student_detail']);
 Route::get('/admin/result/updatestatus/{c_exam_id}/{status}', [AdminController::class,'update_exam_status']);
 
 Route::get('/admin/class/delete/{class_id}', [AdminController::class,'delete_class']);
 Route::get('/admin/user/delete/{id}', [AdminController::class,'delete_teacher']);

});
Route::group(['middleware'=>['TeacherProtected']],function(){
	Route::get('/teacher/dashboard', [TeacherController::class,'index']);
    Route::get('/teacher/subjects', [TeacherController::class,'subjects']);
    Route::get('/teacher/conducted_exams/{req}', [TeacherController::class,'conducted_exams_page']);
    Route::post('teacher/conduct_exam/add', [TeacherController::class,'conduct_new_exam']);
    Route::get('/teacher/result/{req}', [TeacherController::class,'result']);
    Route::post('/teacher/saveresult', [TeacherController::class,'saveresult']);
    
});
Route::group(['middleware'=>['StudentProtected']],function(){
	Route::get('/student/dashboard', [StudentController::class,'index']);
    Route::get('/student/subjects', [StudentController::class,'get_subjects']);
    Route::get('/student/subject/exam/{id}', [StudentController::class,'get_exams']);
    Route::get('/student/DMC', [StudentController::class,'get_dmc']);
});
