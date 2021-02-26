<?php

use App\Http\Controllers\BikeController;
use App\Http\Controllers\BikeRateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopsController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/index', function () {
    return view('layouts/index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profile/{user}', [ProfileController::class, 'userProfile'])->name('profile.user');

Route::get('/ratebike/{bike}',[BikeRateController::class, 'index'])->name('rate.bike');
Route::post('/ratebike/{id}',[BikeRateController::class, 'store'])->name('rate.bike.form');


Route::get('/shops', [ShopsController::class, 'index'])->name('shops');
Route::post('/storeShop',[ShopsController::class, 'store'])->name('store.shop');
Route::get('/shopProfile/{shop}',[ShopsController::class, 'shopProfile'])->name('shop.profile');
Route::get('/addShop', [ShopsController::class, 'viewShopsForm']);

Route::get('/home', [BikeController::class, 'index']);
Route::get('/', [BikeController::class, 'index'])->name('home');
Route::get('/newBike', [BikeController::class, 'new_bike'])->name('addNewBike');
Route::post('/newBike', [BikeController::class, 'store']);

Auth::routes();
