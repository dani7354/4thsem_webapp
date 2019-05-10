<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
// courses
Route::group(['prefix' => 'courses'], function(){


    Route::get('', 'API\CoursesController@index');
    Route::get('{course}', 'API\CoursesController@show');


       Route::middleware('auth:api')->group(function () {

        Route::post('', 'API\CoursesController@store');
        Route::put('{course}', 'API\CoursesController@update');
        Route::delete('{course}', 'API\CoursesController@destroy');

        Route::get('{course}/participants', 'API\CoursesController@participants');
        Route::post('{course}/participants', 'API\CoursesController@participate');
        Route::delete('{course}/participants', 'API\CoursesController@cancel');

      });

});


// articles
Route::group(['prefix' => 'articles'], function(){


    Route::get('', 'API\ArticlesController@index');
    Route::get('{article}', 'API\ArticlesController@show');
    Route::get('tag/{tag}', 'API\ArticlesController@get_by_tag');

       Route::middleware('auth:api')->group(function (){
        Route::post('', 'API\ArticlesController@store');
        Route::put('{article}', 'API\ArticlesController@update');
        Route::delete('{article}', 'API\ArticlesController@destroy');


     });
});

// deadlines
Route::group(['prefix' => 'deadlines'], function(){


    Route::get('', 'API\DeadlinesController@index');
    Route::get('{deadline}', 'API\DeadlinesController@show');
    Route::get('/date/{date}', 'API\DeadlinesController@get_by_date');

      Route::middleware('auth:api')->group(function (){
        Route::put('{deadline}', 'API\DeadlinesController@update');
        Route::delete('{deadline}', 'API\DeadlinesController@destroy');
        Route::post('', 'API\DeadlinesController@store');
      });
});

// meetings
Route::group(['prefix' => 'meetings'], function () {
    Route::get('', 'API\MeetingsController@index');
    Route::get('{meeting}', 'API\MeetingsController@show');

      Route::middleware('auth:api')->group(function () {
    Route::get('/date/{date}', 'API\MeetingsController@get_by_date');
        Route::put('{meeting}', 'API\MeetingsController@update');
        Route::delete('{meeting}', 'API\MeetingsController@destroy');
        Route::post('', 'API\MeetingsController@store');
      });
});

// tokens
Route::middleware('auth:api')->group(function () {
    Route::get('token', 'API\ApiTokenController@show');
    Route::get('token/new', 'API\ApiTokenController@update');

});

Route::post('auth', 'API\APITokenController@login');