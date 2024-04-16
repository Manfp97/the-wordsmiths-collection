<?php

use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\BookmarkController;
use App\Http\Controllers\Web\GenreController;
use App\Http\Controllers\Web\AuthorController;
use App\Http\Controllers\Web\BookReviewController;
use App\Http\Controllers\Web\SubscriptionPlanController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\UserController;
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

Route::get('/', [GenreController::class, 'index']);
Route::get('/genre/{genre:slug}', [GenreController::class, 'show']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/book/{book:slug}', [BookController::class, 'show']);
Route::get('/book/{book:slug}/read', [BookController::class, 'read']);

Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/author/{author:slug}', [AuthorController::class, 'show']);

Route::inertia('/subscribe', 'Subscribe');

Route::post('/subscription-plan/{id}', [SubscriptionPlanController::class, 'select']);

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

	Route::post('/review/{book_id}', [BookReviewController::class, 'store'])->name('review.store');
	Route::put('/review/{id}', [BookReviewController::class, 'update'])->name('review.update');
	Route::delete('/review/{id}', [BookReviewController::class, 'destroy'])->name('review.destroy');

	Route::post('/bookmark', [BookmarkController::class, 'upsert'])->name('bookmark.upsert');
});

Route::middleware('admin')->group(function () {
	Route::post('/genre', [GenreController::class, 'store']);
	Route::put('/genre/{id}', [GenreController::class, 'update']);
	Route::delete('/genre/{id}', [GenreController::class, 'destroy']);

	Route::post('/book', [BookController::class, 'store']);
	Route::put('/book/{id}', [BookController::class, 'update']);
	Route::delete('/book/{id}', [BookController::class, 'destroy']);

	Route::post('/author', [AuthorController::class, 'store']);
	Route::put('/author/{id}', [AuthorController::class, 'update']);
	Route::delete('/author/{id}', [AuthorController::class, 'destroy']);

	Route::get('/users', [UserController::class, 'index']);
	Route::put('/user/{id}', [UserController::class, 'update']);
	Route::delete('/user/{id}', [UserController::class, 'destroy']);
});

require __DIR__.'/auth.php';
