<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Models\Vendor;


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
    return redirect()->route('home');
});
Route::get('/home', [HomeController::class, 'home'])->name('home');

/**
 * Auth Module
 * 
 */
Route::get('/register', [AuthController::class, 'showRegisterPage']);
Route::post('/register', [AuthController::class, 'registration']);

Route::get('/login', [AuthController::class, 'showLoginPage'])->name('showLoginPage');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/**
 * User Module
 * 
 */
Route::get('user/dashboard', [UserController::class, 'home']);
Route::get('post/create/{unique_id}', [PostController::class, 'create'])->name('post.create');
Route::post('post', [PostController::class, 'store'])->name('post.store');




/**
 * Vendor Module
 * 
 */
Route::group(['prefix' => 'vendor', 'as' => 'vendor.', 'middleware' => ['vendor']], function () {
    Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
    Route::get('/earning', [VendorController::class, 'earning']);
    Route::get('/profile', [VendorController::class, 'profile']);
    Route::get('/payment/request', [VendorController::class, 'paymentRequest']);
    Route::get('/payment/reques/{transanction_id}', [VendorController::class, 'sendPayRequestToAdmin']);
    Route::get('/profile/update', [VendorController::class, 'profilePage']);
    Route::post('/profile/update', [VendorController::class, 'profileUpdate']);

    Route::get('/appsetting', [VendorController::class, 'appSetting']);
    Route::post('/appsetting', [VendorController::class, 'updateFacebookAppIdAppSecret']);
});


Route::middleware(['vendor'])->group(function () {
    Route::get('/facebook/login', [FacebookController::class, 'facebookConnect']);
    Route::get('/facebook/accessToken', [FacebookController::class, 'generateAccessToken']);
});

/**
 * Admin Module
 * 
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/earning', [AdminController::class, 'earning']);
    Route::get('/payment/request', [AdminController::class, 'paymentRequest']);
    Route::get('/payment/pending', [AdminController::class, 'paymentPending']);
    Route::get('/payment/request/{transanction_id}', [AdminController::class, 'payNow']);

    Route::get('/post/price',[AdminController::class,'postPrice']);
    Route::post('/post/price',[AdminController::class,'updatePostPrice']);

});

/**
 * 
 * Payment module
 */

Route::get('payment', [PaymentController::class, 'index']);
Route::post('charge', [PaymentController::class, 'charge']);
Route::post('success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('error', [PaymentController::class, 'error']);



Route::get('/test',function(){

    $app_id_app_secret = Vendor::select('app_id', 'app_secret')->where('unique_id', Auth::user()->unique_id)->first();

    return $app_id_app_secret->app_secret;
});



Route::get('/auth',[FacebookController::class,'appIdAndAppSecret']);