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
Route::get('/clone', 'CloneHtmlController@clone');

Route::get('/admin/login', 'Auth\LoginController@getLoginAdmin')->name('admin.getLogin');
Route::post('/admin/login', 'Auth\LoginController@postLoginAdmin')->name('admin.postLogin');

Route::get('/', 'Client\HomeController@index')->name('index');

Route::group(['prefix'=>'category'], function(){
    Route::get('/{id}', 'Client\HomeController@category')->name('category');
});

Route::group(['prefix'=>'product'], function(){
    Route::get('/{id}', 'Client\HomeController@product')->name('product');
});

Route::get('/register', 'Auth\RegisterController@getRegister')->name('getRegister');
Route::post('/register', 'Auth\RegisterController@postRegister')->name('postRegister');

Route::get('/login', 'Auth\LoginController@getLogin')->name('getLogin');
Route::post('/login', 'Auth\LoginController@postLogin')->name('postLogin');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/forgot-password', 'Auth\LoginController@getForgotPassword')->name('getForgotPassword');
Route::group(['middleware' => 'web'], function() {
    Route::post('/forgot-password', 'Auth\LoginController@postForgotPassword')->name('postForgotPassword');
});
