<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blogs/{id}', [HomeController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LogoutController::class, 'logout']);
    Route::resources([
        '/posts' => PostController::class,
        '/categories' => CategoryController::class
    ]);
});

Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('login', 'authenticate');
    });
    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'register');
        Route::post('register', 'store');
    });
});
