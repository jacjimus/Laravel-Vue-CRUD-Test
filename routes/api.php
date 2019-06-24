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

// List hotels

Route::get('hotels' , 'HotelsController@index');

//Show single hotel
Route::get('hotel/{id}' , 'HotelsController@show');

//edit hotel details

Route::put('hotel' , 'HotelsController@store');

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact jacjimus@gmail.com'], 404);
});


