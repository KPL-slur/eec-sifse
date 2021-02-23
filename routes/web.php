<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

/*
|--------------------------------------------------------------------------
| USER/TECH/AUTH ROUTES
|--------------------------------------------------------------------------
|
| Semua routes yang hanya bisa di akses oleh user
| atau tech atau siapapun yang memiliki akun
| tolong ditaro disini, karena pada route
| ini digunakan middleware auth
|
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/tech', [App\Http\Controllers\TechController::class, 'index'])->name('tech');
    
    // PM REPORT ROUTES
    Route::get('report/pm/create/{headId}', ['App\Http\Controllers\PmBodyReportsController', 'create']); //custom create routing
    Route::resource('report/pm', 'App\Http\Controllers\PmBodyReportsController', ['except' => ['create'], 'parameters' => ['pm' => 'pmBodyReport:head_id',]]);
    // PM REPORT ROUTES
    Route::get('report/cm/create/{headId}', ['App\Http\Controllers\CmBodyReportsController', 'create']); //custom create routing
    Route::resource('report/cm', 'App\Http\Controllers\CmBodyReportsController', ['except' => ['create'], 'parameters' => ['cm' => 'cmBodyReport:head_id',]]);
    // REPORT ROUTES
    Route::resource('report', 'App\Http\Controllers\HeadReportsController', ['parameters' => ['report' => 'headReport',]]);

    // temporary route until i create the report crud controller
    // Route::get('/report/pm/create', function () {
    //     return view('tech.report.pm.create');
    // })->name('report');
    // Route::get('/report/pm', function () {
    //     return view('tech.report.pm.index');
    // })->name('report');
    
    //Bawaan dari template
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
|
| Semua routes yang hanya bisa di akses oleh admin
| tolong ditaro disini, karena pada route ini
| digunakan middleware IsAdmin
|
*/

Route::middleware(['auth', 'is_admin'])->group(function () {
    //Halaman Pertama Admin
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Halaman Statis Admin
    //Nanti jgn lupa dihapus semua ini

    Route::get('typography', function () {
        return view('pages.typography');
    })->name('typography');

    Route::get('icons', function () {
        return view('pages.icons');
    })->name('icons');

    Route::get('map', function () {
        return view('pages.map');
    })->name('map');

    Route::get('notifications', function () {
        return view('pages.notifications');
    })->name('notifications');

    Route::get('rtl-support', function () {
        return view('pages.language');
    })->name('language');

    Route::get('upgrade', function () {
        return view('pages.upgrade');
    })->name('upgrade');

    //user_management
    Route::get('userManagement', [App\Http\Controllers\UserController::class, 'index'])->name('userManagement');
    Route::post('addUser', [App\Http\Controllers\UserController::class, 'addData']);
    Route::get('editUser/{id}', [App\Http\Controllers\UserController::class, 'index']);
    Route::post('editUser', [App\Http\Controllers\UserController::class, 'editData']);
    Route::delete('deleteUser/{id}', [App\Http\Controllers\UserController::class, 'deleteData']);


    //distribusi
    Route::get('distribution', [App\Http\Controllers\DistributionController::class, 'index'])->name('distribution');
    Route::get('editDistribution/{id}', [App\Http\Controllers\DistributionController::class, 'edit']);
    Route::post('edit', [App\Http\Controllers\DistributionController::class, 'editData']);
    Route::delete('deleteDistribution/{id}', [App\Http\Controllers\DistributionController::class, 'deleteData']);
    Route::get('addDistribution', [App\Http\Controllers\DistributionController::class, 'add']);
    Route::post('addDst', [App\Http\Controllers\DistributionController::class, 'addData']);

    //site
    Route::get('site', [App\Http\Controllers\SiteController::class, 'index'])->name('site');
    Route::get('addSite', [App\Http\Controllers\SiteController::class, 'add']);
    Route::post('add', [App\Http\Controllers\SiteController::class, 'addData']);
    Route::get('inventory/{id}', [App\Http\Controllers\SiteController::class, 'show']);
    Route::get('/inventorySite/{id}', [App\Http\Controllers\SiteController::class, 'print']);

    //expertActivity
    Route::get('expertActivity', [App\Http\Controllers\ExpertActivityController::class, 'index'])->name('expertActivity'); 
    Route::get('pm', [App\Http\Controllers\ExpertActivityController::class, 'indexPM']); 
    Route::get('addPm', [App\Http\Controllers\ExpertActivityController::class, 'add']); 
    Route::post('addPM', [App\Http\Controllers\ExpertActivityController::class, 'addData']); 
    Route::delete('deletePm/{id}', [App\Http\Controllers\ExpertActivityController::class, 'deleteData']);
    Route::get('editPm/{id}', [App\Http\Controllers\ExpertActivityController::class, 'editPm']);
    Route::post('editPM', [App\Http\Controllers\ExpertActivityController::class, 'editDataPm']);

    Route::get('cm', [App\Http\Controllers\ExpertActivityController::class, 'indexCM']); 
    
    //stock with currencies
    Route::get('stock_currency', [App\Http\Controllers\StockController::class, 'index'])->name('stock_currency'); // index stocks
    Route::get('stock_currency/{stock}/edit', [App\Http\Controllers\StockController::class, 'edit']); //edit specific stock
    Route::post('stock_currency/', [App\Http\Controllers\StockController::class, 'store']); // save new sparepart
    Route::get('stock_currency/create', [App\Http\Controllers\StockController::class, 'create'])->name('stock_currency_create'); // input new spare part
    Route::put('stock_currency/{stock}/update', [App\Http\Controllers\StockController::class, 'update']); // save the edited stock
    Route::delete('stock_currency/{stock}', [App\Http\Controllers\StockController::class, 'destroy']); // delete specific spare part
    Route::get('stock_currency/{date_start}/{date_end}/', [App\Http\Controllers\StockController::class, 'report']);
    Route::get('recommendation', [App\Http\Controllers\StockController::class, 'showRecommendation'])->name('recommendation'); //recommendation item
});
