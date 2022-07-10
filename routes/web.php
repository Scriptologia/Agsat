<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'adminka', 'as' => 'admin.'], function () {
    /** Миграции со сбросом данных **/
    Route::get('/migrate/fresh', function () {
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
    });
    /** Очистить всё **/
    Route::get('/clear/all', function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
    });
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/migrate', function () {
            Artisan::call('migrate');
        });
        /** Миграции со сбросом данных **/
        Route::get('/migrate/fresh', function () {
            Artisan::call('migrate:fresh');
            Artisan::call('db:seed');
        });
        /** Очистить всё **/
        Route::get('/clear/all', function () {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('config:clear');
        });
    });
    /** Очистить кэш **/
    Route::get('/clear/cache', function () {
        Artisan::call('cache:clear');
    });
    /** Создать линк на Storage **/
    Route::get('/storage/link', function () {
        Artisan::call('storage:link');
    });
});

Route::get('setlocale/{locale}', function (\Illuminate\Http\Request  $request, $locale) {
    if (! in_array($locale, ['uk', 'ru'])) {abort(400); }
    App::setLocale($locale);
    $url = url()->previous();
    $url = SetLocale::getUrl($locale, $url);
    return redirect()->to($url );
})->name('setlocale');

Route::group(['domain' => 'adminka.'.env('APP_DOMAIN'), 'as' => 'admin.', 'namespace' => 'Admin'], function () {
       Route::get('/{any}', 'HomeController@index')->where('any', '.*' );
});


Route::group([ 'prefix' => SetLocale::getLocale()], function () {

//    dd(App::getLocale());
    Route::get('/contacts', function() {
       return view('contacts', ['company' =>  \App\Models\Company::first()]);
    })->name('contacts');
    Route::get('/page/{page}', 'HomeController@page')->name('page' );
    Route::get('/basket', 'HomeController@basket')->name('basket');
    Route::get('/{category}/{any?}', 'HomeController@productsOfCategory')->where('any', '.*' )->name('category');
    Route::get('/', 'HomeController@index')->name('home');
});

//Route::group([ 'namespace' => 'Api'], function () {
//    Route::post('/api/basket-from-frontend', 'BasketController@createFromFrontend');
//});

//Route::group(['namespace' => 'Api'], function () {
//    Route::post('/basket-from-frontend', 'BasketController@createFromFrontend');
//});
Auth::routes();