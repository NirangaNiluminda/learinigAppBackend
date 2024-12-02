<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::group(['namespace' => 'Api'], function () {

    // Only one login route, pointing to the correct method
    Route::post('/login', [UserController::class, 'login']);
    //Route::post('/login','UserController@createUser');

    // Authentication middleware group using Sanctum
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::any('courseList', [CourseController::class, 'courseList']);
    });
});

   



Route::get('/student', function () {
    return "test api";
});