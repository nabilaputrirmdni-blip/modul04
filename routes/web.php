<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Models\Book;

// Route login (guest)
Route::get('/', [AuthController::class, 'showLogin'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route setelah login
Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        $books = Book::latest()->get();
        return view('home', compact('books'));
    })->name('home');

    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);

});