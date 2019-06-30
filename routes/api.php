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


Route::group(['middleware' => ['auth:api']], function() {

// Hotels CRUD
    Route::group(['prefix' => 'hotels', 'as' => 'hotels'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'HotelsController@index']);
        Route::put('update', ['as' => 'update', 'uses' => 'HotelsController@store']);
    });

    //Rooms CRUD
    Route::group(['prefix' => 'rooms', 'as' => 'rooms'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'RoomsController@index']);
        Route::post('save', ['as' => 'save', 'uses' => 'RoomsController@store']);
        Route::put('edit', ['as' => 'edit', 'uses' => 'RoomsController@store']);
        Route::delete('del/{id}', ['as' => 'delete', 'uses' => 'RoomsController@destroy']);
    });

    //Room types CRUD
    Route::group(['prefix' => 'types', 'as' => 'types'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'RoomtypesController@index']);
        Route::post('save', ['as' => 'save', 'uses' => 'RoomtypesController@store']);
        Route::put('edit', ['as' => 'update', 'uses' => 'RoomtypesController@store']);
        Route::delete('del/{id}', ['as' => 'delete', 'uses' => 'RoomtypesController@destroy']);
    });

    //Room type prices
    Route::group(['prefix' => 'prices', 'as' => 'types'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'PricesController@index']);
        Route::post('save', ['as' => 'save', 'uses' => 'PricesController@store']);
        Route::put('edit', ['as' => 'update', 'uses' => 'PricesController@store']);
        Route::delete('del/{id}', ['as' => 'delete', 'uses' => 'PricesController@destroy']);
    });

    //Seasons
    Route::group(['prefix' => 'seasons', 'as' => 'types'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'SeasonsController@index']);
        Route::post('save', ['as' => 'save', 'uses' => 'SeasonsController@store']);
        Route::put('edit', ['as' => 'update', 'uses' => 'SeasonsController@store']);
        Route::delete('del/{id}', ['as' => 'delete', 'uses' => 'SeasonsController@destroy']);
    });

    //Room capacity CRUD
    Route::group(['prefix' => 'capacity', 'as' => 'capacity'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'RoomcapacityController@index']);
        Route::put('/update', ['as' => 'update', 'uses' => 'RoomcapacityController@store']);
        Route::delete('{id}', ['as' => 'delete', 'uses' => 'RoomcapacityController@delete']);
    });
    // List hotels


});

Route::fallback(function(){
    return response()->json([
         'message' => 'Page Not Found. If error persists, contact jacjimus@gmail.com'], 404);
});


