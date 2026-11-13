<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;

Route::resource('buku', BookController::class);

Route::resource('kategori', CategoryController::class)->except('show');

Route::resource('penerbit', PublisherController::class)->except('show');

Route::resource('penulis', AuthorController::class)->except('show');