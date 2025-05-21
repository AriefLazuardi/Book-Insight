<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/books', [BookController::class, 'index'])->name('books.index');

Route::get('/top-author', [AuthorController::class, 'topauthor'])->name('authors.top');

Route::get('/books/rating', [BookController::class, 'showForm'])->name('books.rating');
Route::get('/books/by-author/{authorId}', [BookController::class, 'getBooksByAuthor']);
Route::post('/books/rating', [BookController::class, 'store'])->name('books.rating.submit');
