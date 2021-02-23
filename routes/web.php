<?php

use App\Http\Controllers\BikeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/home', [BikeController::class, 'index']);
Route::get('/', [BikeController::class, 'index'])->name('home');
Route::get('/newBike', [BikeController::class, 'new_bike'])->name('addNewBike');
Route::post('/newBike', [BikeController::class, 'store']);

Auth::routes();
