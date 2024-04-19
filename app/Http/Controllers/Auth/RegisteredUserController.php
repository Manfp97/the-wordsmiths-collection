<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
	/**
	 * Display the registration view.
	 */
	public function create(Request $request): Response|RedirectResponse
	{
		$user = $request->user();

		if (!$user) {
			return Inertia::render('Auth/Register');
		} else if (!$user->hasVerifiedEmail()) {
			return redirect()->route('verification.notice');
		} else if (!$user->creditCard) {
			return redirect()->route('payment');
		}

		return redirect()->intended(RouteServiceProvider::HOME);
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'username'	=> 'required|string|max:255|unique:users,username',
			'email'			=> 'required|string|lowercase|email|max:255|unique:'.User::class,
			'password'	=> ['required', 'confirmed', Rules\Password::defaults()],
		]);

		$user = User::create([
			'role_id'		=> 2,
			'username'	=> $request->username,
			'email'			=> $request->email,
			'password'	=> Hash::make($request->password),
		]);

		event(new Registered($user));

		Auth::login($user);

		return redirect()->route("verification.notice");
	}
}
