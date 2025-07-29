<?php

use App\Http\Controllers\UserController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;


Route::get('/login',[UserController::class, 'auth'])->name('login');
Route::post('/login',[UserController::class, 'authentication'])->name('auth.login');

Route::get('/login/register',[UserController::class, 'regist'])->name('member-regist');
Route::post('/login/register',[UserController::class, 'register'])->name('member-register');

Route::middleware('warga')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
    Route::post('/logout',[UserController::class, 'logout'])->name('logout');
});
