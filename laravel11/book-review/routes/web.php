<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});


Route::resource('books', \App\Http\Controllers\BookController::class)
    ->only(['index', 'show']);

Route::resource('books.reviews', ReviewController::class)
    ->scoped(['reviews' => 'book'])
    ->only(['create', 'store']);
