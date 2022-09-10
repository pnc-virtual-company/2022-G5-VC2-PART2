<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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


// route students //
Route::get("/students", [StudentController::class ,  'index']);
Route::get("/students/{id}", [StudentController::class , 'show']);
Route::post("/students", [StudentController::class , 'store']);
Route::post("/students/{id}", [StudentController::class , 'update']);
Route::delete("/students/{id}", [StudentController::class ,'destroy']);

// Route User(teacher and student)
Route::post('/users',[UserController::class,'signUp']);
Route::post('/users/{id}',[UserController::class,'update']);
Route::get('/users/studentOnly',[UserController::class,'studentOnly']);
Route::get('/users/teacherOnly',[UserController::class,'teacherOnly']);
Route::get('/users/{id}',[UserController::class,'show']);
Route::delete('users/{id}',[UserController::class,'destroy']);
