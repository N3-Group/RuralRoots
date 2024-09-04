<?php

//razorpay

use App\Http\Controllers\Payment\razorpayController;
use App\Http\Controllers\Payment\ToyyibpayController;
use App\Http\Controllers\Payment\MyfatoorahController;
use App\Http\Controllers\Payment\KhaltiController;

Route::controller(razorpayController::class)->group(function () {
    Route::get('/razorpay/index', 'pay');
    Route::post('/razorpay/callback', 'callback')->name('razorpay.callback');
});

//Admin
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::controller(razorpayController::class)->group(function () {
        Route::get('/razorpay_configuration', 'credentials_index')->name('razorpay.index');
        Route::post('/razorpay_configuration_update', 'update_credentials')->name('razorpay.update_credentials');
    });
});

//Toyyibpay
Route::controller(ToyyibpayController::class)->group(function () {
    Route::get('toyyibpay-status', 'paymentstatus')->name( 'toyyibpay-status');
    Route::post('/toyyibpay-callback', 'callback')->name( 'toyyibpay-callback');
});

//Myfatoorah START
Route::get('/myfatoorah/callback', [MyfatoorahController::class,'callback'])->name('myfatoorah.callback');

//Khalti START
Route::any('/khalti/payment/done', [KhaltiController::class,'paymentDone'])->name('khalti.success');
