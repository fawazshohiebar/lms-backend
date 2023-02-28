<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassesController;

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
