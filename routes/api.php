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

Route::group(['middleware' => 'auth:sanctum', 'as' => 'api.', 'namespace' => 'Api'], function () {
    Route::get('get-categories', 'CategoryController@index')->withoutMiddleware(['auth:sanctum']);
    Route::get('get-filters/{category}', 'FilterController@getFilters')->withoutMiddleware(['auth:sanctum']);
    Route::get('get-products-of-category/{category}', 'ProductController@getProductsOfCategory');
    Route::get('get-dop-products/{product}', 'ProductController@getDopProducts');
    Route::post('products-count', 'ProductController@getProductsCount');
    Route::get('get-product/{product}', 'ProductController@getProduct')->withoutMiddleware(['auth:sanctum']);
    Route::get('get-sliders', 'SliderController@index')->withoutMiddleware(['auth:sanctum']);
    Route::get('search', 'SearchController@search')->withoutMiddleware(['auth:sanctum']);
    Route::post('basket-from-frontend', 'BasketController@createFromFrontend')->withoutMiddleware(['auth:sanctum']);
//    Route::post('baskets', 'BasketController@index')->withoutMiddleware(['auth:sanctum']);

    Route::get('media', 'MediaController@getFolder');
    Route::post('media', 'MediaController@postToFolder');
    Route::post('media/delete-files', 'MediaController@deleteFiles');
    Route::delete('media', 'MediaController@destroy');

//    Route::get('create-token', 'TokenController@tokenAbilities')->missing(function (Request $request) {
//        return response()->json(['status' => false, 'message' => 'Такого токена нет!']);
//    });
    Route::get('user/autor', 'UserController@user');

    Route::apiResource('user', UserController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такого пользователя нет!']);
    })->except(['edit', 'show', 'create']);
    Route::apiResource('pages', PageController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такой страницы нет!']);
    })->except(['edit', 'show', 'create']);
    Route::apiResource('role', RoleController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такой роли нет!']);
    })->except(['edit', 'show', 'create']);
    Route::apiResource('permission', PermissionController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Таких прав нет!']);
    })->except(['edit', 'show', 'create']);
    Route::apiResource('product', ProductController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такого товара нет!']);
    })->except(['edit', 'show', 'create']);
    Route::apiResource('company', CompanyController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Описание компании нет']);
    })->except(['edit', 'show', 'create']);
    Route::apiResource('sliders', SliderController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такой слайда нет!']);
    })->except(['edit', 'show', 'create']);
    Route::apiResource('curs', CursController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такой валюты нет!']);
    })->except(['edit', 'show', 'create']);
    Route::apiResource('resizes', ResizeController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такого размера нет!']);
    })->except(['edit', 'show', 'create']);
    Route::apiResource('filter', FilterController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такого фильтра нет!']);
    })->except(['edit', 'show', 'create']);
    Route::apiResource('category', CategoryController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такой категории нет!']);
    })->except(['edit', 'show', 'create']);
    Route::apiResource('baskets', BasketController::class)->missing(function (Request $request) {
        return response()->json(['status' => false, 'message' => 'Такого заказа нет!']);
    })->except(['edit', 'show', 'create']);

});
