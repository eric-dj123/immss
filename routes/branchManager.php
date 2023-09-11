<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VirtualPobController;
use App\Http\Controllers\Admin\PhysicalPobController;
use App\Http\Controllers\Admin\ReceiveDispatchController;

Route::middleware('auth')->group(function () {

      // PhysicalPobController
      Route::controller(PhysicalPobController::class)->name('physicalPob.')->group(function () {
        Route::get('/physicalPob', 'index')->name('index');
        Route::get('/physicalmonth', 'monthlypob')->name('index1');
        Route::get('/physicalPob/details/{id}', 'details')->name('details');
        Route::get('/physicalPob/approved', 'approved')->name('approved');
        Route::get('/box/physical/{pdate}' , 'transactionpbox')->name('detailphy');
        Route::get('/physicalPob/waitingList', 'waitingList')->name('waitingList');
        Route::post('/physicalPob', 'paymentStore')->name('paymentStore');
        Route::put('/physicalPob/{id}', 'update')->name('update');
        Route::put('physicalPob/transfer/{id}', 'transfer')->name('transfer');
        Route::put('physicalPob/approve/{id}', 'approve')->name('approve');
        Route::delete('physicalPob/reject/{id}', 'reject')->name('reject');
        Route::get('physicalPob/download/{id}', 'download')->name('download');
        Route::get('physicalPob/selling', 'pobSelling')->name('selling');
        Route::put('physicalPob/selling/{id}', 'pobSellingPut')->name('pobSellingPut');
        Route::get('physicalPob/invoice/{id}', 'invoice')->name('invoice');
        // dailyIncome
        Route::get('physicalPob/dailyIncome', 'dailyIncome')->name('dailyIncome');
        // monthlyIncome
        Route::get('physicalPob/monthlyIncome', 'monthlyIncome')->name('monthlyIncome');

        Route::get('physicalPob/preform/{id}', 'preforma')->name('preforma');
        Route::post('physicalPob/preform/{id}', 'preformaStore')->name('preformaStore');
        Route::get('physicalPob/pobCategory/{month}', 'pobCategory')->name('pobCategory');


    });
    // VirtualPobController
    Route::controller(VirtualPobController::class)->name('virtualPob.')->group(function () {
        Route::get('/virtualPob', 'index')->name('index');
        Route::get('/virtualPob/details/{id}', 'details')->name('details');
        Route::get('/box/virtual/{pdate}' , 'transactionvbox')->name('detailv');
        Route::get('/virtualPob/approved', 'approved')->name('approved');
        Route::get('/virtualPob/waitingList', 'waitingList')->name('waitingList');
        Route::post('/virtualPob', 'paymentStore')->name('paymentStore');
        Route::put('/virtualPob/{id}', 'update')->name('update');
        Route::put('virtualPob/transfer/{id}', 'transfer')->name('transfer');
        Route::put('virtualPob/approve/{id}', 'approve')->name('approve');
        Route::delete('virtualPob/reject/{id}', 'reject')->name('reject');
        Route::get('virtualPob/download/{id}', 'download')->name('download');
         // dailyIncome
         Route::get('virtualPob/dailyIncome', 'dailyIncome')->name('dailyIncome');
         // monthlyIncome
         Route::get('virtualPob/monthlyIncome', 'monthlyIncome')->name('monthlyIncome');

    });
       // receiveDispatchController
       Route::controller(ReceiveDispatchController::class)->name('receiveDispatch.')->group(function () {
        Route::get('/receiveDispatch', 'index')->name('index');
        Route::put('/receiveDispatch/{id}', 'confirmRecieved')->name('confirmRecieved');
        Route::get('/receiveDispatch/show/{id}', 'show')->name('show');
        Route::get('/receiveDispatch/confirmed', 'confirmed')->name('confirmed');
        Route::put('/receiveDispatch/received/{id}', 'recieved')->name('recieved');
    });



});
