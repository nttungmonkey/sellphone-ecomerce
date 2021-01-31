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

Route::get('admin/api/v1/products/getReImg/{pro_id}', 'Api\ApiController@getReImg')->name('admin.products.getReImg');
Route::get('admin/api/v1/getSupplier', 'Api\ApiController@getSupplier')->name('admin.getSupplier');
Route::get('admin/api/v1/getModels', 'Api\ApiController@getModels')->name('admin.getModels');
Route::get('admin/api/v1/getManufacture', 'Api\ApiController@getManufacture')->name('admin.getManufacture');
Route::get('admin/api/v1/getAddress', 'Api\ApiController@getAddress')->name('admin.getAddress');
