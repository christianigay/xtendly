<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function() {

});
Route::post('user/insert', 'UserController@insert');