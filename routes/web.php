<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ClientController, CatatanController, ProfilController, OptionController};

Route::get('/', function () {
    return view('home.index');
});

Route::resource('client', ClientController::class);
Route::resource('catatan', CatatanController::class);
Route::resource('profil', ProfilController::class);
Route::resource('option', OptionController::class);
