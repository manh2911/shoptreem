<?php

Route::get('/', 'Admin\HomeController@index')->name('index');
Route::get('/logout', 'Auth\LoginController@logoutAdmin')->name('logout');

//user
Route::resource('user', 'Admin\UserController')->only([
    'index', 'create', 'store', 'edit', 'update', 'show'
]);
Route::group(['prefix'=>'user'], function(){
    Route::get('{id}/delete', 'Admin\UserController@delete')->name('user.delete');
    Route::patch('{id}/changePassword', 'Admin\UserController@changePassword')->name('user.changePassword');
    Route::post('action', 'Admin\UserController@action')->name('user.action');
});

//category
Route::resource('category', 'Admin\CategoryController')->only([
    'index', 'create', 'store', 'edit', 'update'
]);
Route::group(['prefix'=>'category'], function(){
    Route::get('{id}/delete', 'Admin\CategoryController@delete')->name('category.delete');
    Route::post('action', 'Admin\CategoryController@action')->name('category.action');
});

//brand
Route::resource('brand', 'Admin\BrandController')->only([
    'index', 'create', 'store', 'edit', 'update'
]);
Route::group(['prefix'=>'brand'], function(){
    Route::get('{id}/delete', 'Admin\BrandController@delete')->name('brand.delete');
    Route::post('action', 'Admin\BrandController@action')->name('brand.action');
});

//product
Route::resource('product', 'Admin\ProductController')->only([
    'index', 'create', 'store', 'edit', 'update'
]);
Route::group(['prefix'=>'product'], function(){
    Route::get('{id}/delete', 'Admin\ProductController@delete')->name('product.delete');
    Route::post('action', 'Admin\ProductController@action')->name('product.action');
    Route::get('{id}/active', 'Admin\ProductController@active')->name('product.active');
    Route::get('{id}/inactive', 'Admin\ProductController@inactive')->name('product.inactive');
});

Route::group(['prefix'=>'order'], function(){
    Route::get('/', 'Admin\OrderController@index')->name('order.index');
    Route::post('/change-status', 'Admin\OrderController@changeStatus')->name('order.changeStatus');
    Route::post('/show-detail', 'Admin\OrderController@showDetail')->name('order.showDetail');
});


