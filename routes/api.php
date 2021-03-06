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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api', 'middleware' => 'auth:api'], function() {
    Route::get('/me', 'UsersController@me');
    Route::get('/events', 'UsersController@events');
    Route::get('/hits/{projectId}', 'HitsController@byProject');
    Route::post('/gps', 'UsersController@saveLocation');
    Route::post('/hits/{projectId}', 'HitsController@store');
    Route::post('/hits/images/{hitId}', 'HitsController@updateImage');
});