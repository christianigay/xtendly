<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function() {
    Route::post('auth/logout', 'AuthenticationController@logout');
});
Route::post('auth/login', 'AuthenticationController@login');