<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['as' => 'api.', 'namespace' => 'Api'], function () {
    Route::get('media', 'MediaController@getFolder');
    Route::post('media', 'MediaController@postToFolder');
    Route::post('media/delete-files', 'MediaController@deleteFiles');
    Route::delete('media', 'MediaController@destroy');

    Route::apiResource('product', ProductController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такого товара нет!']);
    })->except(['edit']);
    Route::apiResource('company', CompanyController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Описание компании нет']);
    })->except(['edit']);
    Route::apiResource('sliders', SliderController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такой слайда нет!']);
    })->except(['edit']);
    Route::apiResource('curs', CursController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такой валюты нет!']);
    })->except(['edit']);
    Route::apiResource('resizes', ResizeController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такого размера нет!']);
    })->except(['edit']);
    Route::apiResource('filter', FilterController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такого фильтра нет!']);
    })->except(['edit']);
    Route::apiResource('category', CategoryController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такой категории нет!']);
    })->except(['update', 'edit']);
    Route::post('category/{category}', 'CategoryController@update')->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такой категории нет!']);
    })->name('category.update');
});
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
