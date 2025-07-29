<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');

});
route::get('/login', [UserController::class, 'index'])->name('login');
route::get('/regist', [UserController::class, 'register'])->name('regist');
route::post('login', [UserController::class, 'auth'])->name('login.auth');
route::get('/login/register',[UserController::class, 'register'])->name('register');
route::post('login/register', [UserController::class, 'store'])->name('register.store');
