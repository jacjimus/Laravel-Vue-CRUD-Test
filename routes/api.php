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
// Hotels CRUD
Route::group(['prefix'=>'hotels','as'=>'hotels'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'HotelsController@index']);
    Route::put('update', ['as' => 'update', 'uses' => 'HotelsController@store']);
});

//Rooms CRUD
Route::group(['prefix'=>'rooms','as'=>'rooms'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'RoomsController@index']);
    Route::post('save', ['as' => 'save', 'uses' => 'RoomsController@store']);
    Route::put('update', ['as' => 'update', 'uses' => 'RoomsController@store']);
    Route::delete('delete', ['as' => 'delete', 'uses' => 'RoomsController@delete']);
});

//Room types CRUD
Route::group(['prefix'=>'types','as'=>'types'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'RoomtypesController@index']);
    Route::put('update', ['as' => 'update', 'uses' => 'RoomtypesController@store']);
    Route::delete('delete', ['as' => 'delete', 'uses' => 'RoomtypesController@delete']);
});

//Room capacity CRUD
Route::group(['prefix'=>'capacity','as'=>'capacity'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'RoomcapacityController@index']);
    Route::put('update', ['as' => 'update', 'uses' => 'RoomcapacityController@store']);
    Route::delete('delete', ['as' => 'delete', 'uses' => 'RoomcapacityController@delete']);
});
// List hotels



Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact jacjimus@gmail.com'], 404);
});


