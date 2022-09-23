<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:web'], function() {
    Route::get('user/details', 'UserController@details');
});
Route::post('user/insert', 'UserController@insert');