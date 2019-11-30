<?php

use Illuminate\Http\Request;

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

/* API v1 */
Route::group(['prefix' => 'v1', 'namespace'=>'API\V1'], function(){

    // api/auth
    Route::group(['prefix'=>'auth'], function(){
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
    });

    // Yeu cau xac thuc
    //Route::group(['middleware' => 'jwt.auth'], function () {
    Route::group([], function () {
        Route::apiResource('users', 'UserController');
        Route::apiResource('classes', 'UniversityClassController');
        Route::apiResource('students', 'StudentController');
        Route::apiResource('courses', 'CourseController');
        Route::apiResource('teachers', 'TeacherController');
        Route::apiResource('courseclasses', 'CourseClassController');
    });
});
