<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\ClassBatchController;
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
Route::get('/login/confirm-email',[UserController::class,'confirmEmail']);
Route::post('/login/set-password/{id}',[UserController::class,'createNewPassword']);
// Private Route ------------=========
// Route::group(['middleware' => ['auth:sanctum']], function() {
    // route students //
    Route::prefix('/students')->group(function() {
        Route::get('/getLastStudent',[StudentController::class, 'getLastStudent']);
    });
    // Route User(teacher and student)
    Route::prefix('/users')->group(function() {
        // Route Coordinator 
        Route::post('/',[UserController::class,'registerUser']);
        Route::put('/{id}',[UserController::class,'update']);
        Route::get('/students',[UserController::class,'studentOnly']);
        Route::get('/teachers',[UserController::class,'teacherOnly']);
        Route::get('/student/{id}',[UserController::class,'showOneStudent']);
        Route::get('/teacher/{id}',[UserController::class,'showOneTeacher']);
        Route::delete('/delete/{id}',[UserController::class,'destroy']);
        Route::post('/logout',[UserController::class,'logout']);
    });

    // Route Batchs
    Route::get('/batches',[BatchController::class,'index']);
    Route::post('/batches',[BatchController::class,'store']);
    Route::post('/batch/{id}',[BatchController::class,'update']);
    Route::get('/batch/{id}',[BatchController::class,'show']);
    Route::delete('delete/batch/{id}',[BatchController::class,'destroy']);

    // Route Class
    Route::get('/classes',[ClassBatchController::class,'index']);
    Route::post('/classes',[ClassBatchController::class,'store']);
    Route::post('/class/{id}',[ClassBatchController::class,'update']);
    Route::get('/class/{id}',[ClassBatchController::class,'show']);
    Route::delete('/delete/class/{id}',[ClassBatchController::class,'destroy']);

    // Public route to get image
    Route::get('/storage/image/{image}', [UserController::class, 'getProfile']); /* The route to display a specific profile image */
// });


Route::get('/getStudent',[StudentController::class,'getStudent']);