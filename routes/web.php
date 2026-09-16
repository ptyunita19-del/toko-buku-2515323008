<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku', [BookController::class, 'index']);

Route::get('/buku/{id}', [BookController::class, 'show']);