<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PaymentRequest;
use App\Models\CreditCard;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
	/**
	 * Display the payment view.
	 */
	public function show(): Response
	{
		return Inertia::render('Auth/Payment');
	}

	/**
	 * Handle an incoming payment request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(PaymentRequest $request): RedirectResponse
	{
		$validatedData = $request->validated();
		$book = CreditCard::create([
			'user_id' => $request->user()->id,
			'cardholder_name' => $validatedData['cardholder_name'],
			'card_number' => $validatedData['card_number'],
			'expiration_month' => $validatedData['expiration_month'],
			'expiration_year' => $validatedData['expiration_year'],
			'cvc' => $validatedData['cvc'],
		]);

		return redirect()->route("confirmation");
	}
}
