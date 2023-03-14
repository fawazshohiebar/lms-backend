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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Protected Route

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

});
/////////////////////
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/getuser', [AuthController::class, 'index']);
Route::get('/user/search/{searchterm}', [AuthController::class, 'search']);


/////////////////////


Route::post('/admin/post', [AdminController::class, 'store']);
Route::get('/admin/read', [AdminController::class, 'index']);
Route::put('/admin/edit/{id}', [AdminController::class, 'update']);
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy']);
Route::get('/admin/search/{searchterm}', [AdminController::class, 'search']);


Route::post('/classes/post', [ClassesController::class, 'store']);
Route::get('/classes/read', [ClassesController::class, 'index']);
Route::put('/classes/edit/{id}', [ClassesController::class, 'update']);
Route::delete('/classes/delete/{id}', [ClassesController::class, 'destroy']);
Route::get('/classes/search/{class}', [ClassesController::class, 'search']);




Route::post('/section/post', [SectionsController::class, 'store']);
Route::get('/section/read', [SectionsController::class, 'index']);
Route::put('/section/edit/{id}', [SectionsController::class, 'update']);
Route::delete('/section/delete/{id}', [SectionsController::class, 'destroy']);
Route::get('/section/search/{sec}', [SectionsController::class, 'search']);
Route::get('/section/search/class/{classid}', [SectionsController::class, 'sectiongetter']);


Route::post('/courses/post', [CoursesController::class, 'store']);
Route::get('/courses/read', [CoursesController::class, 'index']);
Route::put('/courses/edit/{id}', [CoursesController::class, 'update']);
Route::delete('/courses/delete/{id}', [CoursesController::class, 'destroy']);
Route::get('/courses/search/{cname}', [CoursesController::class, 'search']);


Route::get('/student/read', [StudentController::class, 'index']);

Route::post('/student/post', [StudentController::class, 'store']);
Route::put('/student/edit/{id}', [StudentController::class, 'update']);
Route::delete('/student/delete/{id}', [StudentController::class, 'destroy']);
Route::get('/student/search/{name}', [StudentController::class, 'search']);
Route::get('/student/search/section/{sectionid}', [StudentController::class, 'studentsgetter']);
Route::get('/student/search/id/{student_id}', [StudentController::class, 'studentprofile']);
Route::get('/students', [StudentController::class, 'searches']);
Route::get('/students/{id}', [StudentController::class, 'studensearch']);
Route::get('/students/sec/{id}', [StudentController::class, 'studentsearchbysection']);

Route::post('/attendance', [AttendanceController::class, 'store']);
Route::get('/attendance', [AttendanceController::class, 'index']);
Route::put('/attendance/{id}', [AttendanceController::class, 'update']);
Route::get('/attendance/search/{Date}', [AttendanceController::class, 'search']);
Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy']);


Route::get('/attendance/bar-graph-records',[AttendanceController::class,'barGraphRecords']);
