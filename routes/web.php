<?php

use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\AuthorController;
use App\Http\Controllers\Web\BookReviewController;
use App\Http\Controllers\Web\SubscriptionPlanController;
use App\Http\Controllers\Web\ProfileController;
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

Route::get('/', [CategoryController::class, 'index']);

Route::get('/book/{book:slug}', [BookController::class, 'show']);
Route::get('/book/{book:slug}/read', [BookController::class, 'read']);
Route::post('/book', [BookController::class, 'store']); // auth => admin
Route::post('/category', [CategoryController::class, 'store']); // auth => admin
Route::post('/author', [AuthorController::class, 'store']); // auth => admin

Route::inertia('/subscribe', 'Subscribe');

Route::post('/subscription-plan/{id}', [SubscriptionPlanController::class, 'select']);

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

	Route::post('/review/{book_id}', [BookReviewController::class, 'store'])->name('review.store');
	Route::put('/review/{id}', [BookReviewController::class, 'update'])->name('review.update');
	Route::delete('/review/{id}', [BookReviewController::class, 'destroy'])->name('review.destroy');
});

require __DIR__.'/auth.php';
