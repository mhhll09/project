<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ClientController, CatatanController, ProfilController, OptionController};
use App\Http\Controllers\GoogleController;
use App\Models\{client};

Route::get('/api/{any}', function ($any) {
    return response()->json(['message' => 'API endpoint: ' . $any]);
})->where('any', '.*');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('/', function () {
    return view('home.index');
});

Route::get('client/show', [ClientController::class, 'show'])->name('client.show');
Route::post('/catatan', [CatatanController::class, 'store'])->name('catatan.store');
Route::get('/catatan', [CatatanController::class, 'show'])->name('catatan.show');

Route::resource('client', ClientController::class);
Route::resource('catatan', CatatanController::class);
Route::resource('profil', ProfilController::class);
Route::resource('option', OptionController::class);
