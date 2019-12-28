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
Route::group([
    'prefix' => 'v1',
    'namespace'=>'API\V1'],
    function(){

    // api/auth
    Route::group(['prefix'=>'auth'], function(){
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
    });

    // Yeu cau xac thuc
    Route::group(['middleware' => 'jwt.auth'], function () {
    //Route::group([], function () {
        Route::get('users/me', 'UserController@me');
        Route::apiResource('users', 'UserController');
        Route::get('classes/meta', 'UniversityClassController@meta');
        Route::apiResource('classes', 'UniversityClassController');

        Route::get('students/meta', 'StudentController@meta');
        //Route::get('students/export', 'StudentController@export');
        //Route::get('students/import', 'StudentController@import');
        Route::apiResource('students', 'StudentController');
        Route::apiResource('courses', 'CourseController');
        Route::get('teachers/meta', 'TeacherController@meta');
        Route::apiResource('teachers', 'TeacherController');

        Route::get('courseclasses/meta', 'CourseClassController@meta');
        Route::apiResource('courseclasses', 'CourseClassController');
        Route::apiResource('scores', 'ScoreController')->only(['index', 'store']);
        Route::apiResource('score_columns', 'ScoreColumnController')->only(['destroy']);
        Route::post('data/import', 'ImportController@import');
        Route::post('data/export', 'ExportController@export');
    });

    //Route::get('students/export/download/{id}', 'StudentController@downloadExportedFile');
});

