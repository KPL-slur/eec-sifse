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
    // Route::get('report/pm/{pmBodyReport:head_id}', [App\Http\Controllers\PmBodyReportsController::class, 'show']);

    Route::resource('report/pm', App\Http\Controllers\PmBodyReportsController::class)->parameters([
        'pm' => 'pmBodyReport:head_id',
    ]);
    // REPORT ROUTES
    Route::resources([
        'report' => App\Http\Controllers\HeadReportsController::class,
    ]);

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
    Route::get('table-list', function () {
        return view('pages.table_list');
    })->name('table');

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

    //distribusi
    Route::get('distribution', [App\Http\Controllers\DistributionController::class, 'index'])->name('distribution');
    Route::get('editDistribution/{id}', [App\Http\Controllers\DistributionController::class, 'edit']);
    Route::post('edit', [App\Http\Controllers\DistributionController::class, 'editData']);
    Route::delete('deleteDistribution/{id}', [App\Http\Controllers\DistributionController::class, 'deleteData']);
    Route::get('addDistribution', [App\Http\Controllers\DistributionController::class, 'add']);
    Route::post('add', [App\Http\Controllers\DistributionController::class, 'addData']);

    //site
    Route::get('site', [App\Http\Controllers\SiteController::class, 'index'])->name('site');
    Route::get('inventorie/{id}', [App\Http\Controllers\SiteController::class, 'show']);
    Route::get('inventorySite', [App\Http\Controllers\SiteController::class, 'print']);

    
    //stock with currencies
    Route::get('stock_currency', [App\Http\Controllers\StockController::class, 'index'])->name('stock_currency');
    Route::get('stock_currency/create', [App\Http\Controllers\StockController::class, 'create'])->name('stock_currency_create');
    Route::post('stock_currency', [App\Http\Controllers\StockController::class, 'store']);
});
