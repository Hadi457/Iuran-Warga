<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');

});
Route::get('/login',[UserController::class, 'auth'])->name('login');
Route::post('/login',[UserController::class, 'authentication'])->name('auth');
Route::get('/login/register',[UserController::class, 'regist'])->name('member-regist');
Route::post('/login/register',[UserController::class, 'register'])->name('member-register');
