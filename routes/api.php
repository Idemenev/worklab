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

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () {

    // Авторизованные
    Route::group(['middleware' => 'jwt.verify'], function () {
        Route::post('user/update', 'UserController@update');

        Route::apiResource('products', 'ProductController');
        Route::apiResource('categories', 'CategoryController');
    });
    Route::post('authenticate', 'UserController@authenticate');

    // Товары в категории
    Route::get('category-products/{category}', 'ProductController@categoryProducts')->where(['category' => '\d+']);

    Route::get('products/{product}', 'ProductController@show')->where(['product' => '\d+']);

    Route::get('categories', 'CategoryController@index');
});
