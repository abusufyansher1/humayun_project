<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\facades\Auth;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});
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

});
Route::group(['middleware'=>['TeacherProtected']],function(){
	Route::get('/teacher/dashboard', [TeacherController::class,'index']);
});
Route::group(['middleware'=>['StudentProtected']],function(){
	Route::get('/student/dashboard', [StudentController::class,'index']);
});
