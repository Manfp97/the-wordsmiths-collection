<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
	/**
	 * Mark the authenticated user's email address as verified.
	 */
	public function __invoke(EmailVerificationRequest $request): RedirectResponse
	{
		if ($request->user()->hasVerifiedEmail()) {
			if (!$request->user()->creditCard()) {
				return redirect()->intended('/payment'); // route('payment')
			} else {
				return redirect()->intended('/');
			}

			// BEFORE: no if-else block, just the line below:
			//return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
		}

		if ($request->user()->markEmailAsVerified()) {
			event(new Verified($request->user()));
		}

		return redirect()->intended('/payment'); // route('payment')
		//return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
	}
}
