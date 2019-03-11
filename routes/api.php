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

    });

});


// articles
Route::group(['prefix' => 'articles'], function(){


    Route::get('', 'API\ArticlesController@index');
    Route::get('{article}', 'API\ArticlesController@show');

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

    Route::middleware('auth:api')->group(function (){
        Route::put('{deadline}', 'API\DeadlinesController@update');
        Route::delete('{deadline}', 'API\DeadlinesController@destroy');
        Route::post('', 'API\DeadlinesController@store');
    });
});

// tokens
Route::middleware('auth:api')->group(function () {
    Route::get('token', 'API\ApiTokenController@show');
    Route::get('token/new', 'API\ApiTokenController@update');

});