<?php

use App\Http\Controllers\AdministratorControlller;
use App\Http\Controllers\DuesCategoryController;
use App\Http\Controllers\DuesMemberController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Models\DuesCategory;
use App\Models\DuesMember;
use Illuminate\Support\Facades\Route;


Route::get('/login',[UserController::class, 'auth'])->name('login');
Route::post('/login',[UserController::class, 'authentication'])->name('auth.login');

Route::middleware('warga')->group(function () {
    Route::get('/', function () {
        $data['tagihan'] = DuesCategory::all();
        return view('home', $data);
    })->name('home');
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
    Route::get('/edit-profil/{id}',[UserController::class, 'edit'])->name('profile-edit');
    Route::post('/edit-profil/{id}',[UserController::class, 'update'])->name('profile-update');
    Route::get('/tata', [UserController::class, 'tata'])->name('tata');
    Route::get('/contact', [UserController::class, 'contact'])->name('contact');
});

Route::post('/logout',[UserController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    Route::get('/dashbord', [AdministratorControlller::class, 'index'])->name('dashboard');
    Route::get('/officer', [OfficerController::class, 'officer'])->name('officer');
    Route::get('/officer/create',[OfficerController::class, 'create'])->name('officer-create');
    Route::post('/officer/create',[OfficerController::class, 'store'])->name('officer-store');
    Route::get('/officer/edit/{id}',[OfficerController::class, 'edit'])->name('officer-edit');
    Route::post('/officer/edit/{id}',[OfficerController::class, 'update'])->name('officer-update');
    Route::get('officer/delete/{id}',[OfficerController::class, 'delete'])->name('officer-delete');
    Route::get('/kategori-iuran', [DuesCategoryController::class, 'index'])->name('kategori-iuran');
    Route::get('/data-warga', [UserController::class, 'datawarga'])->name('data-warga');
    Route::get('/create-warga',[UserController::class, 'create'])->name('warga-create');
    Route::post('/create-warga',[UserController::class, 'store'])->name('warga-store');
    Route::get('/delete-warga/{id}',[UserController::class, 'delete'])->name('warga-delete');
    Route::get('/edit-warga/{id}',[UserController::class, 'edit'])->name('warga-edit');
    Route::post('/edit-wargat/{id}',[UserController::class, 'update'])->name('warga-update');
    Route::get('/create-kategori-iuran',[DuesCategoryController::class, 'create'])->name('iuran-create');
    Route::post('/create-kategori-iuran',[DuesCategoryController::class, 'store'])->name('iuran-store');
    Route::get('/edit-kategori-iuran/{id}',[DuesCategoryController::class, 'edit'])->name('iuran-edit');
    Route::post('/edit-kategori-iuran/{id}',[DuesCategoryController::class, 'update'])->name('iuran-update');
    Route::get('/delete-kategori-iuran/{id}',[DuesCategoryController::class, 'delete'])->name('iuran-delete');
    
    Route::get('/payment/create',[PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payment/create',[PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payment',[PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payment/detail/{id}',[PaymentController::class, 'detail'])->name('payments.detail');
    Route::get('/payment/delete/{id}',[PaymentController::class, 'delete'])->name('payments.destroy');

    Route::get('/anggota-iuran', [DuesMemberController::class, 'index'])->name('anggota-iuran');

});
