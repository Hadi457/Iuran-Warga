<?php

use App\Http\Controllers\AdministratorControlller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/login',[UserController::class, 'auth'])->name('login');
Route::post('/login',[UserController::class, 'authentication'])->name('auth.login');

Route::middleware('warga')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
    Route::get('/edit', [UserController::class, 'edit'])->name('edit');
    Route::get('/tata', [UserController::class, 'tata'])->name('tata');
    Route::get('/contact', [UserController::class, 'contact'])->name('contact');
});

Route::post('/logout',[UserController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/dashbord', [AdministratorControlller::class, 'index'])->name('dashboard');
    Route::get('/iuran', [AdministratorControlller::class, 'iuran'])->name('data-iuran');
    Route::get('/data-warga', [UserController::class, 'datawarga'])->name('data-warga');
    Route::get('/create-warga',[UserController::class, 'create'])->name('warga-create');
    Route::post('/create-warga',[UserController::class, 'store'])->name('warga-store');
});
