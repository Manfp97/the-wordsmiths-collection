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

Route::inertia('/', 'Index');

Route::inertia('/subscribe', 'Subscribe');
Route::inertia('/pricing', 'Pricing');
Route::inertia('/login', 'LogIn');

Route::inertia('/register/account', 'Register/Account');
Route::inertia('/register/verification', 'Register/Verification');
Route::inertia('/register/payment', 'Register/Payment');
Route::inertia('/register/confirmation', 'Register/Confirmation');