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
Route::group(["prefix"=>"v1",'middleware' => ['api']],function(){
    Route::get('/getHeaderMenu',"Api\Home@getListMenu");
    Route::get('/category/{route}',"Api\Home@getCategory");
    Route::get('/product/list',"Api\Home@getListProduct");
    Route::get('/product/view/{route}',"Api\Home@getDetailProduct");
    Route::get('/getListOptionFilter',"Api\Home@getListOptionFilter");
    Route::get('/loadListProvince',"Api\Home@loadListProvince");
    Route::post('/login',"Api\Verify@login");
    Route::post('/register',"Api\Verify@register");
    Route::group(["prefix"=>"customer",'middleware' => ['jwt.auth']],function(){
        Route::get('/getInfo',"Api\Customer@getInfo");
        Route::put('/updateInfo',"Api\Customer@updateInfo");
        Route::get('/getInfoShipping',"Api\Customer@getInfoShipping");
        Route::post('/addInfoShip',"Api\Customer@addInfoShip");
        Route::post('/addOrder',"Api\Customer@addOrder");
        Route::delete("/deleteAddress","Api\Customer@deleteAddress");
    });
});