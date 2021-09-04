<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StoreController;
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
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});
//temp route
Route::get('/atur', function(){
    return view('pages.seller.index');
});
Route::get('/dashboard', function () {
    return view('pages.seller.dashboard');
});
//endtemptou
Route::resource('login', LoginController::class);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/chooseRole', [RegisterController::class, 'chooseRole'])->name('choose-role');
Route::post('/getRole', [RegisterController::class, 'getRole'])->name('get-role');
Route::resource('register', RegisterController::class);
Route::resource('stores', StoreController::class);
Route::resource('/dashboard', DashboardController::class);
Route::resource('product', ProductController::class);