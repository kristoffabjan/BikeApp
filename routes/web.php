<?php

use App\Http\Controllers\BikeController;
use App\Http\Controllers\BikeRateController;
use App\Http\Controllers\BikesAtShopContoller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopRateController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\TestController;
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
Route::post('/shopImages/{id}', [ShopsController::class, 'storeImages'])->name('shopImages');
Route::get('/deleteShop/{shop}', [ShopsController::class, 'destroy'])->name('delete.shop');
Route::get('/editShop/{shop}', [ShopsController::class, 'edit_form'])->name('edit.shop');
Route::post('/editShopData/{shop}', [ShopsController::class, 'edit'])->name('edit.shop.data');


Route::post('/rateshop/{id}',[ShopRateController::class, 'store'])->name('rate.shop');
Route::get('/editShopRate/{rate}/rate/{shop}',[ShopRateController::class, 'edit_form'])->name('edit.shop.rate');
Route::post('/editShopRateData/{rate}/rate/{shop}',[ShopRateController::class, 'edit'])->name('edit.shop.rate.data');
Route::get('/destroyShopRate/{rate}',[ShopRateController::class, 'destroy'])->name('destroy.shop.rate');


Route::get('/newTest/{id}',[TestController::class, 'insert'])->name('new.test');
Route::post('/newTest/{id}',[TestController::class, 'create']);


Route::get('/home', [BikeController::class, 'index']);
Route::get('/', [BikeController::class, 'index'])->name('home');
Route::get('/newBike', [BikeController::class, 'new_bike'])->name('addNewBike');
Route::post('/newBike', [BikeController::class, 'store']);
Route::post('/bikeImages/{id}', [BikeController::class, 'storeImages'])->name('bikeImages');
Route::get('/deleteBike/{bike}', [BikeController::class, 'destroy'])->name('delete.bike');
Route::get('/editBike/{bike}', [BikeController::class, 'edit_form'])->name('edit.bike');
Route::post('/editBikeData/{bike}', [BikeController::class, 'edit'])->name('edit.bike.data');



Route::get('/bikeToShop/{shop}', [BikesAtShopContoller::class, 'index'])->name('bikeToShop');
Route::get('/bikeToShop/{shop}/{bike}', [BikesAtShopContoller::class, 'store'])->name('bikeToShop.add');
Route::get('/bikeToShop/{shop}/bike/{bikeShop}', [BikesAtShopContoller::class, 'destroyEntry'])->name('bikeToShop.destroy');

Auth::routes();
