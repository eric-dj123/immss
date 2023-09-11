<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPobController;
use App\Http\Controllers\PricingApiController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\DispachOpeningController;
use App\Http\Controllers\Eric\AirportMailController;
use App\Http\Controllers\Admin\PhysicalPobController;
use App\Http\Controllers\MobileAPI\CustomerController;
use App\Http\Controllers\MobileAPI\UserAuthController;
use App\Http\Controllers\Customer\ApplicationController;
use App\Http\Controllers\Admin\DispatchInvoiceController;
use App\Http\Controllers\Eric\Register\EmsMailTransferController;
use App\Http\Controllers\Eric\Register\PercelMailTransferController;
use App\Http\Controllers\Eric\Register\OrdinaryMailTransferController;
use App\Http\Controllers\Eric\Register\OrdinaryLetterTransferController;
use App\Http\Controllers\Eric\Register\RegisteredMailTransferController;
use App\Http\Controllers\Eric\Register\RegisteredLetterTransferController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserAuthController::class)->prefix('driver')->group(function () {
    Route::post('/login', 'login');
});
Route::controller(CustomerController::class)->prefix('customer')->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

// employee routes in employee controller
Route::controller(EmployeeController::class)->prefix('employee')->group(function () {
    Route::get('/', 'api')->name('employee.api');
});


// PhysicalPobController
Route::controller(PhysicalPobController::class)->prefix('physicalPob')->name('physicalPob.')->group(function () {
    Route::get('/{id}', 'pobApi')->name('pobApi');
});
Route::controller(AdminPobController::class)->prefix('adminPhysicalPob')->name('admin.physicalPob.')->group(function () {
    Route::get('/{id}', 'pobApi')->name('pobApi');
});
Route::controller(AdminPobController::class)->prefix('adminVirtualPob')->name('admin.virtualPob.')->group(function () {
    Route::get('vitualPob/{id}', 'vitualPobApi')->name('pobApi');
});

Route::controller(DispatchInvoiceController::class)->name('dispatchInvoice.')->group(function () {
    Route::get('/dispatchInvoice', 'api')->name('api');
});




Route::get('/branches', [BranchController::class, 'api'])->name('branches.api');

Route::controller(AirportMailController::class)->prefix('airportDispach')->name('airportDispach.')->group(function () {
    Route::get('/', 'dispachApi')->name('dispachApi');
});
Route::controller(PricingApiController::class)->prefix('price')->name('price.')->group(function () {
    // Route::get('/get_price', 'getPrice')->name('getPrice');
    Route::post('/get_price', 'getPrice')->name('getPrice');
    Route::post('/get_single_country_price','getSingleCountryPrice')->name('getSingleCountryPrice');
    Route::post('/get_continent_price', 'getContinentPrice')->name('getContinentPrice');
});
Route::controller(RegisteredMailTransferController::class)->prefix('RegisteredApi')->name('RegisteredApi.')->group(function () {
    Route::get('/{id}/{user}', 'RegApi')->name('RegApi');
});
Route::controller(PercelMailTransferController::class)->prefix('PercelApi')->name('PercelApi.')->group(function () {
    Route::get('/{id}/{user}', 'PerApi')->name('PerApi');
});
Route::controller(OrdinaryMailTransferController::class)->prefix('OrdinaryApi')->name('OrdinaryApi.')->group(function () {
    Route::get('/{id}/{user}', 'OrdApi')->name('OrdApi');
});
Route::controller(EmsMailTransferController::class)->prefix('EmsApi')->name('EmsApi.')->group(function () {
    Route::get('/{id}/{user}', 'emApi')->name('emApi');
});
Route::controller(RegisteredLetterTransferController::class)->prefix('RegistereLetterApi')->name('RegistereLetterApi.')->group(function () {
    Route::get('/{id}/{user}', 'regletterapi')->name('regletterapi');
});
Route::controller(OrdinaryLetterTransferController::class)->prefix('OrdinaryLetterApi')->name('OrdinaryLetterApi.')->group(function () {
    Route::get('/{id}/{user}', 'ordletterapi')->name('ordletterapi');
});

// end Eric







//driver rest api
Route::controller(UserAuthController::class)->prefix('driver')->group(function () {
    Route::post('/login', 'login');//driver login
    Route::get('/login-status', 'loginStatus');//login-status
    Route::get('/driver-logout', 'logout');//logout
    Route::get('/driver-mails/{id}', 'showDriverAssignedMail');
    Route::get('/driver-international-mails/{id}', 'showDriverAssignedInternationMail');
    Route::get('/get-total-mails/{id}','countDriverMail');
    Route::get('/get-national-mails/{id}','countNationalMail');
    Route::get('/get-international-mails/{id}','countInternationalMail');
    Route::get('/get-delivered-mails/{id}','countDeliveredMail');
    Route::get('/get-pending-mails/{id}','countPendingMail');
    Route::get('/get-recent-mails/{id}','showRecentMail');
    Route::put('/driver-mail-status-update/{id}', 'updateMailStatus');
    Route::get('/getDriverVehicle/{id}','getDriverVehicle');
    Route::post('/save-route','saveRoute');
    Route::get('/get-driver-route/{id}','showDriverRoute');
    Route::put('/update-driver-route/{id}', 'update');
    Route::post('/save-milleage','saveCalibration');
    Route::get('/get-driver-milleage/{id}','showDriverMilleage');
});
//customer rest api
Route::controller(CustomerController::class)->prefix('customer')->group(function () {
      Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::get('/get-branches', 'getBranches');
    Route::get('/get-branch-pox-box/{id}', 'getAvailablePob');
    Route::get('/get-pox-box/{id}', 'getPobInfo');
    Route::get('/get-customer-address/{id}', 'getPobAddress');
    Route::get('/get-customer-virtual-pob/{id}', 'getCustomerPob');
    Route::get('/get-customer-physical-pob/{id}', 'getCustomerPhysicalPob');
    Route::get('/get-customer-inbox/{id}', 'getInternationalMail');
    Route::get('/get-customer-national/{id}', 'getNationalMail');
    Route::get('/get-total-mails/{id}','countDriverMail');
    Route::post('/pox-box-application', 'pobApplication');
    Route::post('/pox-box-virtual', 'virtualApplication');
    Route::post('/pox-box-existing', 'pobRenew');
    Route::put('/update-home-location/{id}', 'updateHomeAddress');
    Route::put('/update-office-location/{id}', 'updateOfficeAddress');
    Route::get('/customer-get-address/{id}','getBoxInformation');
});




Route::resource('/dispatchopening', DispachOpeningController::class);
