<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Route::group(['namespace' => 'Api'], function () {

//     // Only one login route, pointing to the correct method
//     Route::post('/login', [UserController::class, 'login']);
//     //Route::post('/login','UserController@createUser');

//     // Authentication middleware group using Sanctum
//     Route::group(['middleware' => ['auth:sanctum']], function () {
//         Route::any('/courseList', [CourseController::class, 'courseList']);
//     });
// });

//test

   
Route::post('/login', [UserController::class, 'login']);

//Route::any('/courseList', [CourseController::class, 'courseList']);
// Route::any('/courseDetail', [CourseController::class, 'courseDetail']);
// Route::any('/lessonList', [LessonController::class, 'lessonList']);
// Route::any('/lessonDetail', [LessonController::class, 'lessonDetails']);
// Route::any('/checkout', [PaymentController::class, 'checkouts']);

Route::any('/courseList', [CourseController::class, 'courseList']);
Route::any('/courseDetail', [CourseController::class, 'courseDetail']);
Route::any('/lessonList', [LessonController::class, 'lessonList']);
Route::any('/lessonDetail', [LessonController::class, 'lessonDetails']);

Route::group(['middleware' => ['auth:sanctum']], function () {
            
            Route::any('/checkout', [PaymentController::class, 'checkouts']);

        });


Route::any('/webGoHooks', [PaymentController::class, 'webGoHooks']);

Route::get('/student', function () {
    return "test api";
});