<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/login',[UserController::class, 'auth'])->name('login');
Route::post('/login',[UserController::class, 'authentication'])->name('auth.login');

Route::middleware('warga')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
});

Route::post('/logout',[UserController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/dashbord', function () {
        return view('Administrator.dashboard');
    })->name('dashbord');
    Route::get('/data-warga', [UserController::class, 'datawarga'])->name('data-warga');
    Route::get('/create-warga',[UserController::class, 'create'])->name('warga-create');
    Route::post('/create-warga',[UserController::class, 'store'])->name('warga-store');
});
