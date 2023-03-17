<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Protected Route

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

});
/////////////////////
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/getuser', [AuthController::class, 'index']);
Route::get('/getuser/{id}', [AuthController::class, 'index']);
Route::put('/user/{id}', [AuthController::class, 'update']);
Route::delete('/user/{id}', [AuthController::class, 'destroy']);
Route::get('/user/search/{searchterm}', [AuthController::class, 'search']);


/////////////////////


Route::post('/admin/post', [AdminController::class, 'store']);
Route::get('/admin/read', [AdminController::class, 'index']);
Route::put('/admin/edit/{id}', [AdminController::class, 'update']);
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy']);
Route::get('/admin/search/{searchterm}', [AdminController::class, 'search']);


Route::post('/classes', [ClassesController::class, 'store']);
Route::get('/classes', [ClassesController::class, 'index']);
Route::put('/classes/{id}', [ClassesController::class, 'update']);
Route::delete('/classes/{id}', [ClassesController::class, 'destroy']);
Route::get('/classes/{class}', [ClassesController::class, 'search']);




Route::post('/sections', [SectionsController::class, 'store']);
// Route::get('/section/read', [SectionsController::class, 'index']);
Route::put('/sections/{id}', [SectionsController::class, 'update']);
Route::delete('/sections/{id}', [SectionsController::class, 'destroy']);
Route::get('/sections/{sec}', [SectionsController::class, 'search']);
Route::get('/sections/classes/{classid}', [SectionsController::class, 'sectiongetter']);

Route::get('/classes/{classId}/sections', [SectionsController::class, 'index']);

Route::post('/courses/post', [CoursesController::class, 'store']);
Route::get('/courses/read', [CoursesController::class, 'index']);
Route::put('/courses/edit/{id}', [CoursesController::class, 'update']);
Route::delete('/courses/delete/{id}', [CoursesController::class, 'destroy']);
Route::get('/courses/search/{cname}', [CoursesController::class, 'search']);


// Route::get('/students', [StudentController::class, 'index']);

Route::post('/students', [StudentController::class, 'store']);
Route::put('/student/{id}', [StudentController::class, 'update']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);
Route::get('/students/{name}', [StudentController::class, 'search']);
Route::get('/students/sections/{sectionid}', [StudentController::class, 'studentsgetter']);
Route::get('/students/id/{student_id}', [StudentController::class, 'studentprofile']);
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{id}', [StudentController::class, 'studensearch']);
Route::get('/students/sec/{id}', [StudentController::class, 'studentsearchbysection']);

Route::post('/attendance', [AttendanceController::class, 'store']);
Route::get('/attendance', [AttendanceController::class, 'index']);
Route::put('/attendance/{id}', [AttendanceController::class, 'update']);
Route::get('/attendance/search/{Date}', [AttendanceController::class, 'search']);
Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy']);

Route::get('/attendance/dashboard',[AttendanceController::class,'dashBoard']);
Route::get('/attendance/dashboard/piechart',[AttendanceController::class,'dashBoardPiechart']);
Route::get('/attendance/dashboard/frequent',[AttendanceController::class,'frequentlyAbsentStudents']);

