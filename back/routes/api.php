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
Route::prefix('/forgot')->group(function (){
    Route::post('/findMail',[UserController::class, 'findEmailAccount']);
    Route::post('/confirmCode',[UserController::class, 'confirmVerificationCode']);
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
        Route::post('/{id}',[UserController::class,'update']);
        Route::get('/students',[UserController::class,'studentOnly']);
        Route::get('/teachers',[UserController::class,'teacherOnly']);
        Route::get('/student/{id}',[UserController::class,'showOneStudent']);
        Route::get('/teacher/{id}',[UserController::class,'showOneTeacher']);
        Route::delete('/delete/{id}',[UserController::class,'destroy']);
        Route::post('/logout',[UserController::class,'logout']);
        Route::post('/updateProfile/{id}',[UserController::class,'updateProfile']);
        Route::post('/reset-password/{id}',[UserController::class,'resetPassword']);
        // route to add student into the follow up list 
    });

    Route::prefix('/comments')->group(function () {
            // Route::get('/{id}',[CommentController::class,'getComment']);
            Route::post('/',[CommentController::class,'store']);
            Route::post('/reply',[ReplyCommentController::class,'store']);
            Route::delete('/delete/{id}',[CommentController::class,'destroy']);
    });

    Route::prefix('/follow_ups')->group(function() {
        Route::post('/',[FollowupController::class,'store']);
        Route::get('/',[FollowupController::class,'index']);
        Route::get('/{id}',[FollowupController::class, 'show']);
        Route::delete('/{id}',[FollowupController::class,'removeFollowUp']);
    });

    // Route Batchs
    Route::prefix('/batches')->group( function(){
        Route::get('/',[BatchController::class,'index']);
        Route::post('/',[BatchController::class,'store']);
        Route::put('/{id}',[BatchController::class,'update']);
        Route::get('/{id}',[BatchController::class,'show']);
        Route::delete('/delete/{id}',[BatchController::class,'destroy']);
    });
    // Route Class
    Route::prefix('/classes')->group(function(){
        Route::get('/',[ClassBatchController::class,'index']);
        Route::post('/',[ClassBatchController::class,'store']);
        Route::post('/{id}',[ClassBatchController::class,'update']);
        Route::get('/{id}',[ClassBatchController::class,'show']);
        Route::delete('/delete/{id}',[ClassBatchController::class,'destroy']);
    });
//  });
Route::get('/storage/image/{image}', [UserController::class, 'getProfile']); /* The route to display a specific profile image */
Route::get('/comments/{user_id}/{student_id}',[CommentController::class,'getComment']);
Route::get('/comments/{student_id}',[CommentController::class,'getCommentFromTeacher']);