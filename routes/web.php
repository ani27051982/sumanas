<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/', ['as' => 'getLogin', 'uses' => 'LoginController@showLoginForm']);
    Route::group(['prefix' => 'login', 'as' => 'login.'], function() {
        Route::post('doLogin', 'LoginController@doLogin')->name('doLogin');        
    });
});

Route::group(['middleware' => ['auth:users']], function () {
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
    Route::group(['prefix' => 'restricted', 'as' => "restricted.", 'namespace' => 'Restricted'], function() {
        Route::resources([
            'dashboard' => 'DashboardController'
            ],['only' => 'index']);
        Route::resources([
            'product' => 'ProductController'
        ]);
    });
});
