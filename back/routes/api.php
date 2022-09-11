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
Route::prefix('/students')->group(function() {
    
    Route::post("/", [StudentController::class , 'store']);
    Route::post("/{id}", [StudentController::class , 'update']);
    Route::delete("/delete/{id}", [StudentController::class ,'destroy']);
    Route::get('/getLastId',[StudentController::class, 'getLastId']);
});


// Route User(teacher and student)
Route::prefix('/users')->group(function() {
    Route::post('/',[UserController::class,'registerUser']);
    Route::post('/{id}',[UserController::class,'update']);
    Route::get('/students',[UserController::class,'studentOnly']);
    Route::get('/teachers',[UserController::class,'teacherOnly']);
    Route::get('/{id}',[UserController::class,'show']);
    Route::delete('/delete/{id}',[UserController::class,'destroy']);
});

