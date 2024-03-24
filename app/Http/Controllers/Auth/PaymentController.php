<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PaymentStoreRequest;
use App\Models\CreditCard;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
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
	public function store(PaymentStoreRequest $request): RedirectResponse
	{
		$validatedData = $request->validated();
		CreditCard::create([
			'user_id'						=> $request->user()->id,
			'cardholder_name'		=> $validatedData['cardholder_name'],
			'card_number'				=> $validatedData['card_number'],
			'expiration_month'	=> $validatedData['expiration_month'],
			'expiration_year'		=> $validatedData['expiration_year'],
			'cvc'								=> $validatedData['cvc'],
		]);

		$subscriptionPlan = SubscriptionPlan::find(
			$request->session()->get('selected_subscription_plan_id')
		);
		Subscription::create([
			'user_id'								=> $request->user()->id,
			'subscription_plan_id'	=> $subscriptionPlan->id,
			'end_date'							=> Carbon::now()->addDays($subscriptionPlan->duration_days),
			'status'								=> 'active'
		]);

		return redirect()->route("confirmation");
	}
}
