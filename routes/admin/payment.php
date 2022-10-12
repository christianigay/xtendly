<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function() {
    Route::get('payment/home', 'PaymentController@index');
    Route::post('payment/charge/', 'PaymentController@charge');
    Route::get('payment/success', 'PaymentController@success');
    Route::get('payment/error', 'PaymentController@error');
});