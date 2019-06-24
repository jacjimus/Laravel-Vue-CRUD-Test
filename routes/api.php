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
    Route::put('update', ['as' => 'update', 'uses' => 'RoomsController@store']);
});
// List hotels



Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact jacjimus@gmail.com'], 404);
});


