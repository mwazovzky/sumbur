<?php

Route::resource('/furniture', 'FurnitureController');
Route::resource('/orders', 'OrdersController');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
