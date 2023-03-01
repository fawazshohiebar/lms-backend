<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\StudentController;

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

Route::post('/admin/post', [AdminController::class, 'store']);
Route::get('/admin/read', [AdminController::class, 'index']);
Route::put('/admin/edit/{id}', [AdminController::class, 'update']);
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy']);


Route::post('/classes/post', [ClassesController::class, 'store']);
Route::get('/classes/read', [ClassesController::class, 'index']);
Route::put('/classes/edit/{id}', [ClassesController::class, 'update']);
Route::delete('/classes/delete/{id}', [ClassesController::class, 'destroy']);




Route::post('/section/post', [SectionsController::class, 'store']);
Route::get('/section/read', [SectionsController::class, 'index']);
Route::put('/section/edit/{id}', [SectionsController::class, 'update']);
Route::delete('/section/delete/{id}', [SectionsController::class, 'destroy']);



Route::post('/courses/post', [CoursesController::class, 'store']);
Route::get('/courses/read', [CoursesController::class, 'index']);
Route::put('/courses/edit/{id}', [CoursesController::class, 'update']);
Route::delete('/courses/delete/{id}', [CoursesController::class, 'destroy']);



Route::post('/student/post', [StudentController::class, 'store']);
Route::get('/student/read', [StudentController::class, 'index']);
Route::put('/student/edit/{id}', [StudentController::class, 'update']);
Route::delete('/student/delete/{id}', [StudentController::class, 'destroy']);