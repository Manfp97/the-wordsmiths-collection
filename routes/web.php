<?php

use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\AuthorController;
use App\Http\Controllers\Web\PricingController;
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

Route::get('/pricing', [PricingController::class, 'show'])->name('pricing');
Route::post('/pricing/{subscription_plan_id}', [PricingController::class, 'store']);

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
