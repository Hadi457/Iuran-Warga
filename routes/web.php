<?php

use Illuminate\Support\Facades\Route;

Route::get('/homemade', function () {
    return view('welcome');
});
