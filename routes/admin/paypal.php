<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function() {
    Route::post('paypal/create-product', 'PaypalController@createProduct')->name('make.product');
    Route::post('paypal/handle-payment', 'PaypalController@handlePayment')->name('make.payment');
    Route::post('paypal/cancel-payment', 'PaypalController@cancelPayment')->name('cancel.payment');
    Route::post('paypal/payment-success', 'PaypalController@paymentSuccess')->name('success.payment');
});