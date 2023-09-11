<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminPobController;
use App\Http\Controllers\Admin\BoxController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\DispachOpeningController;
use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Admin\SendDispatchController;
use App\Http\Controllers\Admin\AdminAddressingController;
use App\Http\Controllers\Admin\DispatchInvoiceController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'guest'], function () {
    // Customer Login
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/register', [HomeController::class, 'register'])->name('register');

    Route::prefix('customer')->name('customer.')->group(function () {
        // Route::get('/login', [HomeController::class, 'customer_login'])->name('login');
        // Route::get('/register', [HomeController::class, 'customer_register'])->name('register');
        #customer register on CustomerAuthController controller
        Route::controller(CustomerAuthController::class)->group(function () {
            Route::post('/login', 'login')->name('loginAuth');
            Route::post('/register', 'register')->name('registerAuth');
        });
    });

    // Admin Login
    Route::controller(AdminAuthController::class)->name('admin.')->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'login')->name('loginAuth');
        Route::get('/reset-password', 'resetPassword')->name('resetPassword');
    });
});

// Route::group(['middleware' => 'auth'], function () {
Route::name('admin.')->middleware('auth')->group(function () {
    //    Admin Dashboard
    Route::get('/dashboard', [AdminDashController::class, 'index'])->name('dashboard');
    //    Employees
    Route::controller(EmployeeController::class)->name('employee.')->group(function () {
        Route::get('/employees', 'index')->name('index')->middleware('can:read employee');
        Route::get('/employees/active', 'active')->name('active')->middleware('can:read employee');
        Route::get('/employees/inactive', 'inactive')->name('inactive')->middleware('can:read employee');
        Route::get('/employees/deactivate', 'deactivate')->name('deactivate')->middleware('can:read employee');
        Route::put('/employees/activate/{id}', 'activate')->name('activate');
        Route::post('/employees', 'store')->name('store');
        Route::put('/employees/{id}', 'update')->name('update');
        Route::delete('/employees/{id}', 'destroy')->name('destroy');
        #employee profile
        Route::get('/employees/profile/{id}', 'profile')->name('profile');
        Route::get('/employees/profile', 'profileEdit')->name('profileEdit');
        Route::put('/employees/profile/update', 'profileUpdate')->name('profileUpdate');
        Route::put('/employees/profile/change-password', 'changePassword')->name('changePassword');

    });

    Route::controller(BranchController::class)->name('branch.')->group(function () {
        Route::get('/branch', 'index')->name('index')->middleware('can:read branch');
        Route::post('/branch', 'store')->name('store');
        Route::put('/branch/{id}', 'update')->name('update');
        Route::delete('/branch/{id}', 'destroy')->name('destroy');
    });
    //   End Branche

    //    POBbox
    Route::controller(BoxController::class)->name('box.')->group(function () {
        Route::get('/box', 'index')->name('index');
        Route::post('/box', 'store')->name('store');
        Route::put('/box/{id}', 'update')->name('update');
        Route::delete('/box/{id}', 'destroy')->name('destroy');
    });
    //   End POBbox

   //  addressings
    Route::controller(AdminAddressingController::class)->name('addressing.')->group(function () {
        Route::get('/addressing/individual', 'individual')->name('individual');
        Route::get('/addressing/company', 'company')->name('company');
        Route::get('/addressing/company/{id}', 'members')->name('members');
        Route::get('/addressing/map', 'map')->name('map');
    });

    //    Roles
    Route::controller(RolesController::class)->name('roles.')->group(function () {
        Route::get('/roles', 'index')->name('index')->middleware('can:read roles');
        Route::post('/roles', 'store')->name('store');
        Route::put('/roles/{id}', 'assignRole')->name('assignRole');
        Route::delete('/roles/{id}', 'destroy')->name('destroy');
    });
    //   End Roles

    //    Permissions
    Route::controller(PermissionsController::class)->name('permissions.')->group(function () {
        Route::get('/permissions', 'index')->name('index')->middleware('can:read permission');
        Route::post('/permissions', 'store')->name('store');
        Route::put('/permissions/{id}', 'update')->name('update');
        Route::delete('/permissions/{id}', 'destroy')->name('destroy');
    });
    //   End Permissions
    //    Settings
    Route::controller(SettingController::class)->name('setting.')->group(function () {
        Route::get('/setting', 'index')->name('index')->middleware('can:read setting');
        Route::prefix('setting')->group(function () {
            Route::post('/activity', 'activityStore')->name('store');
            Route::put('/activity/{id}', 'activityUpdate')->name('update');
            Route::delete('/activity/{id}', 'activityDestroy')->name('destroy');
        });
    });
    //   End Settings

    //  SendDispatchController
    Route::controller(SendDispatchController::class)->name('sendDispatch.')->group(function () {
        Route::get('/createDispatch/{id}', 'index')->name('index');
        Route::post('/createDispatch', 'store')->name('store');
        Route::get('/createDispatch/show/{id}', 'show')->name('show');
        Route::delete('/sendDispatch/{id}', 'destroy')->name('destroy');
        Route::post('/createDispatch/show', 'showStore')->name('showStore');
        Route::delete('/createDispatch/show/{id}', 'showDestroy')->name('showDestroy');
        Route::get('/viewDispatch', 'viewDispatch')->name('viewDispatch');
        Route::get('/sentDispatch', 'sentDispatch')->name('sentDispatch');
        Route::get('/recievedDispatch', 'recievedDispatch')->name('recievedDispatch');
        Route::put('/sentDispatch/{id}', 'sentDispatchUpdate')->name('sentDispatchUpdate');
        Route::get('/mails/list/{id}', 'mailsList')->name('mailsList');

    });


    // dispatchInvoiceController
    Route::controller(DispatchInvoiceController::class)->name('dispatchInvoice.')->group(function () {
        Route::get('/dispatchInvoice', 'index')->name('index');
        Route::get('/dispatchInvoice/show/{id}', 'show')->name('show');
        Route::post('/dispatchInvoice', 'store')->name('store');
        Route::get('/dispatchInvoice/showInvoice/{id}', 'showInvoice')->name('showInvoice');
        Route::post('/dispatchInvoice/notification/{id}', 'notificationStore')->name('notificationStore');
        Route::get('/dispatchInvoice/download/{id}', 'download')->name('download');

    });

    Route::controller(AdminPobController::class)->prefix('admin')->group(function () {
        Route::get('/physicalPob', 'index')->name('physicalPob.index');
        Route::get('/virtualPob', 'index_virtualPob')->name('virtualPob.index');
    });



    // change password
    Route::get('/change-password', [AdminAuthController::class, 'changePassword'])->name('changePassword');
    Route::put('/change-password/{id}', [AdminAuthController::class, 'changePasswordStore'])->name('changePasswordStore');

    //    Logout
    Route::get('/logout', [LogoutController::class, 'adminLogout'])->name('logout');
});


// });




