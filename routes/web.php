<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InitiatorController;
use App\Http\Controllers\Admin\WebBannerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StoreController;
use App\Http\Controllers\Seller\StoreImageController;
use App\Http\Controllers\View\ViewController;
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

Route::group(['middleware' => ['auth', 'isSeller']], function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('product', ProductController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('stores-image', StoreImageController::class);
});

Route::resource('login', LoginController::class);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/chooseRole', [RegisterController::class, 'chooseRole'])->name('choose-role');
Route::post('/getRole', [RegisterController::class, 'getRole'])->name('get-role');
Route::resource('register', RegisterController::class);

Route::prefix('/')->group(function () {
    Route::get('', [ViewController::class, 'home']);
    Route::get('about', [ViewController::class, 'about']);
    Route::get('ukm-products', [ViewController::class, 'product']);
    Route::get('ukm-product/{id}', [ViewController::class, 'detailProduct']);
    Route::get('profil', [ViewController::class, 'profil']);
    Route::get('store/{id}', [ViewController::class, 'storeDetail']);
    Route::post('komentReview/{id}', [ViewController::class, 'createReviewsRate'])->name('komentReview');
    Route::patch('editKomentReview/{id}', [ViewController::class, 'editCommentReview'])->name('editCommentReview');
    Route::patch('addRateAndBuy/{id}', [ViewController::class, 'addRateAndBuy'])->name('addRateAndBuy');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('', [AdminController::class, 'index']);
    Route::get('users', [AdminController::class, 'users']);
    Route::get('products', [AdminController::class, 'products']);
    Route::resource('initiators', InitiatorController::class);
    Route::resource('banners', WebBannerController::class);
});
