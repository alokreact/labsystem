<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/signin',[App\Http\Controllers\HomeController::class, 'login'])->name('signin');
Route::post('/create/otp', [App\Http\Controllers\AuthController::class,'generateOTP'])->name('otp.create');
Route::post('/verify/otp', [App\Http\Controllers\AuthController::class,'verifyOTP'])->name('otp.verify');

Route::get('/landing',[App\Http\Controllers\HomeController::class, 'landing'])->name('landing');


Route::get('cart', [App\Http\Controllers\CartController::class,'cart'])->name('cart');

Route::get('/checkout',[App\Http\Controllers\HomeController::class, 'checkout']);

Route::post('/test/add-to-cart', [App\Http\Controllers\CartController::class,'addToCart']);

Route::get('/search',[App\Http\Controllers\HomeController::class, 'search']);
Route::post('/search/test', [App\Http\Controllers\HomeController::class,'getsearchList'])->name('searchList');
Route::post('/searchlabs', [App\Http\Controllers\HomeController::class,'searchLabs'])->name('searchLabs');
Route::get('/list/search-result', [App\Http\Controllers\HomeController::class,'searchResultList']);

Route::post('/search/labs', [App\Http\Controllers\HomeController::class,'searchLabsForTest'])->name('searchLabsForTest');
Route::get('/testbyorgan/{id}', [App\Http\Controllers\OrganController::class, 'getTestbyOrgan'])->name('testbyorgan');
Route::get('/organs/list', [App\Http\Controllers\OrganController::class, 'index'])->name('organs.index');




Route::get('/address',[App\Http\Controllers\AddressController::class, 'index'])->name('address');
Route::post('/address/save', [App\Http\Controllers\AddressController::class, 'store']);

Route::get('/patient',[App\Http\Controllers\PatientController::class, 'index'])->name('patient');
Route::post('/save/patient', [App\Http\Controllers\PatientController::class,'store'])->name('savepatient');

Route::get('/booking',[App\Http\Controllers\HomeController::class, 'booking'])->name('booking');

Route::get('/coupon',[App\Http\Controllers\ProfileController::class, 'coupon'])->name('coupon');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
