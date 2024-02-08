<?php

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

Route::post('/book', [BookController::class, 'store']); // auth => admin
Route::post('/category', [CategoryController::class, 'store']); // auth => admin
Route::post('/author', [AuthorController::class, 'store']); // auth => admin

Route::inertia('/subscribe', 'Subscribe');
Route::inertia('/pricing', 'Pricing');
Route::inertia('/login', 'LogIn');

Route::inertia('/register', 'Register/Account');
Route::inertia('/register/verification', 'Register/Verification');
Route::inertia('/register/payment', 'Register/Payment');
Route::inertia('/register/confirmation', 'Register/Confirmation');