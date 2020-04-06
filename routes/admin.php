<?php

Route::get('/', 'Admin\HomeController@index')->name('index');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('category', 'Admin\CategoryController');
Route::resource('user', 'Admin\UserController');
