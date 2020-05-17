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

Route::get('/admin/login', 'Auth\LoginController@getLogin')->name('admin.getLogin');
Route::post('/admin/login', 'Auth\LoginController@postLogin')->name('admin.postLogin');

Route::get('/', 'Client\HomeController@index')->name('index');

Route::get('/clone', 'CloneHtmlController@clone');
