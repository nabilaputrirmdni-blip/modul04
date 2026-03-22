<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Models\Book;

Route::get('/', function () {
    return view('home');
});
Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);

Route::get('/', function () {
    $books = Book::latest()->get();
    return view('home', compact('books'));
});