<?php

Route::get('/', 'Admin\HomeController@index')->name('index');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('user', 'Admin\UserController')->only([
    'index', 'create', 'store', 'edit', 'update', 'show'
]);
Route::group(['prefix'=>'user'], function(){
    Route::get('{id}/delete', 'Admin\UserController@delete')->name('user.delete');
    Route::patch('{id}/changePassword', 'Admin\UserController@changePassword')->name('user.changePassword');
    Route::post('action', 'Admin\UserController@action')->name('user.action');
});


Route::resource('category', 'Admin\CategoryController');
