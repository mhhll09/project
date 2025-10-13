<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ClientController, CatatanController, ProfilController, OptionController};

Route::get('/', function () {
    return view('home.index');
});

Route::get('client/show', [ClientController::class, 'show'])->name('client.show');

Route::resource('client', ClientController::class);
Route::resource('catatan', CatatanController::class);
Route::resource('profil', ProfilController::class);
Route::resource('option', OptionController::class);
