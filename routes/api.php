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
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::post('logout', 'AuthController@logout');
    Route::get('/authenticate/user', 'AuthController@user');
    Route::group(['prefix' => 'bus/{id}'] ,function() {
        Route::get('destinations', 'BusTripController@getDestination');
        Route::post('newTrip', 'BusTripController@newTrip');
    });
});
