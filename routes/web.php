<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/buku', [BookController::class, 'index'])
    ->name('buku.index');

Route::get('/buku/{id}', [BookController::class, 'show'])
    ->name('buku.show');
