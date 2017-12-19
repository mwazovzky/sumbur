<?php

Route::resource('/furniture', 'FurnitureController');
Route::resource('/orders', 'OrdersController');

Auth::routes();
Route::redirect('/', '/home');
Route::get('/home', 'HomeController@index')->name('home');
