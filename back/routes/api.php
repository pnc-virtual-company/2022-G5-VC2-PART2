<?php

use App\Http\Controllers\UserController;
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

// Public route---------======
// Login Route
Route::post('/login', [UserController::class, 'login']);
// Private Route ------------=========
Route::group(['middleware' => ['auth:sanctum']], function() {
    // route students //
    Route::prefix('/students')->group(function() {
        Route::get('/getLastStudent',[StudentController::class, 'getLastStudent']);
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
        Route::post('/logout',[UserController::class,'logout']);
    });
    // Public route to get image
    Route::get('/storage/image/{image}', [UserController::class, 'getProfile']); /* The route to display a specific profile image */
});

