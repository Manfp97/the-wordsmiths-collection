<?php

use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\BookmarkController;
use App\Http\Controllers\Web\GenreController;
use App\Http\Controllers\Web\AuthorController;
use App\Http\Controllers\Web\BookReviewController;
use App\Http\Controllers\Web\SubscriptionPlanController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\SearchController;
use App\Http\Controllers\Web\LocaleController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [GenreController::class, 'index'])->name('genre.index');
Route::get('/genre/{genre:slug}', [GenreController::class, 'show'])->name('genre.show');

Route::get('/books', [BookController::class, 'index'])->name('book.index');
Route::get('/book/{book:slug}', [BookController::class, 'show'])->name('book.show');

Route::get('/authors', [AuthorController::class, 'index'])->name('author.index');
Route::get('/author/{author:slug}', [AuthorController::class, 'show'])->name('author.show');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');

Route::inertia('/subscribe', 'Subscribe')->name('subscribe');
Route::inertia('/terms-and-conditions', 'TermsAndConditions')->name('terms-and-conditions');

Route::post('/subscription-plan/{id}', [SubscriptionPlanController::class, 'select']);

Route::patch('/locale/{locale}', [LocaleController::class, 'update'])->name('locale.update');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('subscribed')->group(function () {
	Route::get('/book/{book:slug}/read', [BookController::class, 'read'])->name('book.read');

	Route::post('/review/{book_id}', [BookReviewController::class, 'store'])->name('review.store');
	Route::put('/review/{id}', [BookReviewController::class, 'update'])->name('review.update');
	Route::delete('/review/{id}', [BookReviewController::class, 'destroy'])->name('review.destroy');

	Route::post('/bookmark', [BookmarkController::class, 'upsert'])->name('bookmark.upsert');
});

Route::middleware('admin')->group(function () {
	Route::post('/genre', [GenreController::class, 'store'])->name('genre.store');
	Route::put('/genre/{id}', [GenreController::class, 'update'])->name('genre.update');
	Route::delete('/genre/{id}', [GenreController::class, 'destroy'])->name('genre.destroy');

	Route::post('/book', [BookController::class, 'store'])->name('book.store');
	Route::put('/book/{id}', [BookController::class, 'update'])->name('book.update');
	Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');

	Route::post('/author', [AuthorController::class, 'store'])->name('author.store');
	Route::put('/author/{id}', [AuthorController::class, 'update'])->name('author.update');
	Route::delete('/author/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');

	Route::get('/users', [UserController::class, 'index'])->name('user.index');
	Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
	Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

require __DIR__ . '/auth.php';
