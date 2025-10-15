<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ClientController, CatatanController, ProfilController, OptionController};
use App\Http\Controllers\GoogleController;

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('/', function () {
    return view('home.index');
});

Route::get('client/show', [ClientController::class, 'show'])->name('client.show');

Route::resource('client', ClientController::class);
Route::resource('catatan', CatatanController::class);
Route::resource('profil', ProfilController::class);
Route::resource('option', OptionController::class);
