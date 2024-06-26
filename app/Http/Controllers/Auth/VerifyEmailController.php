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
			if (!$request->user()->creditCard) {
				return redirect()->route('payment.show');
			}
			
			return redirect()->intended(RouteServiceProvider::HOME);
		}

		if ($request->user()->markEmailAsVerified()) {
			event(new Verified($request->user()));
		}
		
		return redirect()->route('payment.show')->with(
			'alert',
			[
				'type'		=> 'success',
				'message'	=> __('alerts.verify_email_success'),
			]
		); 
	}
}
