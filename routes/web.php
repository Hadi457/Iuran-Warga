<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/login',[UserController::class, 'auth'])->name('login');
Route::post('/login',[UserController::class, 'authentication'])->name('auth.login');

Route::get('/login/register',[UserController::class, 'regist'])->name('warga-regist');
Route::post('/login/register',[UserController::class, 'register'])->name('warga-register');

Route::middleware('warga')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
});

Route::post('/logout',[UserController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/dashbord', function () {
        return view('Administrator.dashbord');
    })->name('dashbord');
});

