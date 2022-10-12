<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function() {
    Route::post('product/add', 'ProductController@add');
    Route::post('product/edit', 'ProductController@edit');
    Route::get('product/list', 'ProductController@list');
    Route::get('product/get/{id}', 'ProductController@getProduct');
});