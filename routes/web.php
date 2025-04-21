<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend;
use App\Http\Controllers\Frontend;
Route::get('/', [Frontend\HomeController::class, 'index'])->name('/');
Route::get('search', [Frontend\PackageController::class, 'search'])->name('search');
Route::get('package', [Frontend\PackageController::class, 'index'])->name('package');
Route::get('package/{package:slug}', [Frontend\PackageController::class, 'cart'])->name('cart');
Route::post('package/pay', [Frontend\PackageController::class, 'pay'])->name('pay');
Route::post('package/pay/success', [Frontend\PackageController::class, 'paySuccess'])->name('paySuccess');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [Backend\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => ['user-access:owner']], function () {
        Route::get('log-activities', [Backend\LogActivityController::class, 'index'])->name('log-activities');
        Route::resource('employees', Backend\EmployeeController::class);
    });

    Route::group(['middleware' => ['user-access:admin']], function () {
        Route::resource('users', Backend\UserController::class);
    });

    Route::group(['middleware' => ['user-access:owner,admin']], function () {
        Route::resources([
            'packages' => Backend\PackageController::class,
            'report' => Backend\ReportController::class,
        ]);

        Route::post('report/export', [Backend\ReportController::class, 'export'])->name('report.export');
        
        Route::get('transactions', [Backend\TransactionController::class, 'index'])->name('transactions');
        Route::get('congregations', [Backend\CongregationController::class, 'index'])->name('congregations');
        Route::get('congregations/{id}', [Backend\CongregationController::class, 'show'])->name('congregations.show');
    });

    Route::group(['middleware' => ['user-access:user']], function () {
        Route::resource('biodata', Backend\Account\BiodataController::class);
    });

    Route::resources([
        'profile' => Backend\Account\ProfileController::class,
        'password-change' => Backend\Account\PasswordController::class,
    ]);
});