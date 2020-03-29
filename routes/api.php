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
Route::group(['middleware' => ['api']],function(){
    Route::get('/v1/getHeaderMenu',"Api\Home@getListMenu");
    Route::get('/v1/category/{route}',"Api\Home@getCategory");
    Route::get('/v1/product/list',"Api\Home@getListProduct");
    Route::get('/v1/product/view/{route}',"Api\Home@getDetailProduct");
    Route::get('/v1/getListOptionFilter',"Api\Home@getListOptionFilter");

    Route::post('/v1/login',"Api\Verify@login");
    
});