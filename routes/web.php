<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/projects/{projectId}', 'ProjectsController@show');
Route::get('/projects/{projectId}/preview', 'ProjectsController@preview');
Route::get('/projects/{projectId}/export', 'ProjectsController@export');

Route::group(['prefix' => 'admin'], function () {

    Route::get('/tracking/negotiators', 'TrackingController@showNegotiators');
    Route::get('/tracking/vehicles', 'TrackingController@showVehicles');
    Route::get('/tracking/{userId}', 'TrackingController@getLocations');
    Route::get('/tracking/{userId}/last', 'TrackingController@getLastLocations');
    Route::get('/reports/gps/{userId}', 'ReportsController@getLocationsPerHour');

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'Admin\UserController@index');
        Route::get('/create', 'Admin\UserController@create');
        Route::post('/import', 'Admin\UserController@importGPSData');
        Route::post('/create', 'Admin\UserController@store');
        Route::get('/update/{id}', 'Admin\UserController@edit');
        Route::post('/update/{id}', 'Admin\UserController@update');
        Route::delete('/{id}', 'Admin\UserController@destroy');
        Route::get('/{id}', 'Admin\UserController@show');
    });

    Route::group(['prefix' => 'projects'], function () {
        Route::get('/', 'Admin\ProjectController@index');
        Route::get('/create', 'Admin\ProjectController@create');
        Route::post('/create', 'Admin\ProjectController@store');
        Route::get('/update/{id}', 'Admin\ProjectController@edit');
        Route::post('/update/{id}', 'Admin\ProjectController@update');
        Route::delete('/{id}', 'Admin\ProjectController@destroy');
        Route::get('/{id}', 'Admin\ProjectController@show');
    });

    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', 'Admin\ReportsController@index');
        Route::get('/{id}', 'Admin\ReportsController@show');
        Route::get('/preview/{id}', 'Admin\ReportsController@preview');
    });

});