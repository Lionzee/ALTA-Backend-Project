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

Route::namespace('API')->group(function (){
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');


    Route::get('product/index','ProductController@index');

    Route::middleware('jwt.verify')->group(function (){
        Route::post('logout', 'UserController@logout');


        //Carts
        Route::post('cart/add','CartController@store');
        Route::get('cart/view','CartController@cart_items');
        Route::delete('item/{item_id}','CartController@delete_item');
        Route::post('item/{item_id}','CartController@update_item');

        //Products
        Route::post('product/create','ProductController@store');

    });


});
