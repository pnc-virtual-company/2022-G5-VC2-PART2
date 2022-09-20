<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\ClassBatchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowUpController;
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
Route::prefix('/login')->group(function() {
    Route::get('/confirmEmail/{email}', [UserController::class, 'confirmEmail']);
    Route::post('/createPassword/{id}',[UserController::class,'createNewPassword']);
    Route::post('/', [UserController::class, 'setPasswordLogin']);
});
Route::get('account/find',[UserController::class,'getUserByToken']);
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
        // route to add student into the follow up list 
        Route::post('/follow_ups',[FollowupController::class,'store']);
        Route::get('/follow_ups',[FollowupController::class,'index']);
        Route::get('/follow_ups/{id}',[FollowupController::class, 'show']);
        Route::delete('/follow_ups/{id}',[FollowupController::class,'destroy']);
    });

    // Route Batchs
    Route::get('/batches',[BatchController::class,'index']);
    Route::post('/batches',[BatchController::class,'store']);
    Route::put('/batch/{id}',[BatchController::class,'update']);
    Route::get('/batch/{id}',[BatchController::class,'show']);
    Route::delete('batch/delete/{id}',[BatchController::class,'destroy']);
    // Route Class
    Route::get('/classes',[ClassBatchController::class,'index']);
    Route::post('/classes',[ClassBatchController::class,'store']);
    Route::post('/class/{id}',[ClassBatchController::class,'update']);
    Route::get('/class/{id}',[ClassBatchController::class,'show']);
    Route::delete('/delete/class/{id}',[ClassBatchController::class,'destroy']);
// });
Route::get('/storage/image/{image}', [UserController::class, 'getProfile']); /* The route to display a specific profile image */

Route::get('/comments',[CommentController::class,'index']);
Route::post('/comments',[CommentController::class,'store']);
Route::post('/comment/{id}',[CommentController::class,'update']);
Route::delete('/delete/comment/{id}',[CommentController::class,'destroy']);