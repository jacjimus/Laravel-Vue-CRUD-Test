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



    //Orders CRUD
    Route::group(['prefix' => 'orders', 'as' => 'orders'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'OrdersController@index']);
        Route::post('save', ['as' => 'save', 'uses' => 'OrdersController@store']);
        Route::put('edit', ['as' => 'edit', 'uses' => 'OrdersController@store']);
        Route::delete('del/{id}', ['as' => 'delete', 'uses' => 'OrdersController@destroy']);
    });

    //Suppliers CRUD
    Route::group(['prefix' => 'suppliers', 'as' => 'types'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'SuppliersController@index']);
        Route::post('save', ['as' => 'save', 'uses' => 'SuppliersController@store']);
        Route::put('edit', ['as' => 'update', 'uses' => 'SuppliersController@store']);
        Route::delete('del/{id}', ['as' => 'delete', 'uses' => 'SuppliersController@destroy']);
    });

    //Products  CRUD
    Route::group(['prefix' => 'products', 'as' => 'types'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'ProductsController@index']);
        Route::post('save', ['as' => 'save', 'uses' => 'ProductsController@store']);
        Route::put('edit', ['as' => 'update', 'uses' => 'ProductsController@store']);
        Route::delete('del/{id}', ['as' => 'delete', 'uses' => 'ProductsController@destroy']);
    });




});

Route::fallback(function(){
    return response()->json([
         'message' => 'Page Not Found. If error persists, contact jacjimus@gmail.com'], 404);
});


