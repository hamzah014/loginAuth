<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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


Auth::routes();

Route::get('/naver/login', [LoginController::class, 'naverLogin'])->name('naver.login');
Route::get('/naver/callback', [LoginController::class, 'naverCallback']);

// Route::get('/naver/callback', function () {
//     $user = Socialite::driver('naver')->user();
//     dump($user);
//     // $user->token
// });

Route::group(['middleware' => 'auth', 'role:admin'], function() {

    Route::get('/', [HomeController::class, 'indexAdmin'])->name('admin.home');
    Route::get('/admin', [HomeController::class, 'indexAdmin'])->name('admin.home');

});

Route::group(['middleware' => 'auth', 'role:member'], function() {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

});

