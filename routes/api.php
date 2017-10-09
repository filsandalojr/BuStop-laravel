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
Route::post('registerUser', 'PassengerController@registerUser');
Route::post('login', 'AuthController@login');
Route::get('getCompanies', 'DriverController@getDetails');
Route::post('registerDriver', 'DriverController@registerDriver');
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::post('logout', 'AuthController@logout');
    Route::get('/authenticate/user', 'AuthController@user');
    Route::group(['prefix' => 'bus/{id}'] ,function() {
        Route::get('destinations', 'BusTripController@getDestination');
        Route::post('newTrip', 'BusTripController@newTrip');
    });
    Route::group(['prefix' => 'passenger/{id}'] ,function() {
        Route::get('initSearch', 'PassengerController@initSearch');
        Route::post('searchTrip', 'PassengerController@searchTrip');
        Route::post('bookTrip', 'PassengerController@bookTrip');
    });
});
