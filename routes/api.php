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
Route::group(['middleware' => ['api', 'cors']],function(){
    Route::get('/v1/getHeaderMenu',"API\Home@getListMenu");
    Route::get('/v1/category/{route}',"API\Home@getCategory");
    Route::get('/v1/product/list',"API\Home@getListProduct");
    Route::get('/v1/product/view/{route}',"API\Home@getDetailProduct");
});
