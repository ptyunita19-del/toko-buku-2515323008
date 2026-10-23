
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;

Route::get('/buku', [BookController::class, 'index'])
    ->name('buku.index');

Route::get('/buku/{id}', [BookController::class, 'show'])
    ->name('buku.show');

Route::resource('kategori', CategoryController::class)->except('show');
