<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:web'], function() {

});
Route::post('auth/login', 'AuthenticationController@login');