<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\{ClientController};
use App\Http\Controllers\GoogleController;

// routes/api.php
Route::get('hello', function() {
    return response()->json(['message' => 'Halo dari Laravel!']);
});

