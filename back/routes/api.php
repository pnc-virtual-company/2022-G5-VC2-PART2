<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FollowupController;
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
    Route::get('/getLastStudent',[StudentController::class, 'getLastStudent']);
    Route::put('/toFollowup/{id}',[StudentController::class, 'update']);
});


// Route User(teacher and student)
Route::prefix('/users')->group(function() {
    Route::post('/',[UserController::class,'registerUser']);
    Route::put('/{id}',[UserController::class,'update']);
    Route::get('/students',[UserController::class,'studentOnly']);
    Route::get('/teachers',[UserController::class,'teacherOnly']);
    Route::get('/student/{id}',[UserController::class,'showOneStudent']);
    Route::get('/teacher/{id}',[UserController::class,'showOneTeacher']);
    Route::delete('/delete/{id}',[UserController::class,'destroy']);
    // route to add student into the follow up list 
    Route::post('/follow_ups',[FollowupController::class,'store']);
    Route::get('/follow_ups',[FollowupController::class,'index']);
    Route::get('/follow_ups/{id}',[FollowupController::class, 'show']);
    Route::delete('/follow_ups/{id}',[FollowupController::class,'destroy']);
});


// Public route to get image
Route::get('/storage/image/{image}', [UserController::class, 'getProfile']); /* The route to display a specific profile image */

