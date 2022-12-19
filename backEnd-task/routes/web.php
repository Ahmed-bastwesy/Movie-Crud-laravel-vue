<?php

use App\Http\Controllers\Administrator\RoleController;
use App\Http\Controllers\Administrator\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Movie\MovieController;
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


Route::get('/login', [AuthController::class, 'loginForm'])
    ->middleware('guest:dashboard')
    ->name('login');

Route::post('/login', [AuthController::class, 'doLogin'])
    ->middleware('guest:dashboard')->name('doLogin');

Route::group(['middleware' => ['auth:dashboard']], static function () {
    Route::get('/',[HomeController::class, 'index'])->name('home');
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('movie', MovieController::class);
    Route::post('/toggle/{user}',[UserController::class, 'toggle'])->name('user.toggle');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});




