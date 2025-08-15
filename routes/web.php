<?php

use App\Http\Controllers\ArrangementController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EndUserController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\LicenseTypeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Devices routes
    Route::get('devices', [DeviceController::class, 'index'])->name('devices.index');

    //Licenses routes
    Route::get('licenses', [LicenseController::class, 'index'])->name('licenses.index');

    //Endusers routes
    Route::get('end-users', [EndUserController::class, 'index'])->name('end-users.index');

    //Services routes
    Route::get('services', [ServiceController::class, 'index'])->name('services.index');

    //Divisions routes
    Route::get('divisions', [DivisionController::class, 'index'])->name('divisions.index');

    //User roles routes
    Route::get('user-roles', [UserRoleController::class, 'index'])->name('user-roles.index');

    //Suppliers routes
    Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');

    //Device types routes
    Route::get('device-types', [DeviceTypeController::class, 'index'])->name('device-types.index');

    //License types routes
    Route::get('license-types', [LicenseTypeController::class, 'index'])->name('license-types.index');

    //Brands routes
    Route::get('brands', [BrandController::class, 'index'])->name('brands.index');

    //Statuses routes
    Route::get('statuses', [StatusController::class, 'index'])->name('statuses.index');

    //Arrangements routes
    Route::get('arrangements', [ArrangementController::class, 'index'])->name('arrangements.index');
});



require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
