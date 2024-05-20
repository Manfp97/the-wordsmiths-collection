<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PaymentRequest;
use App\Providers\RouteServiceProvider;
use App\Models\CreditCard;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
	/**
	 * Display the payment view.
	 */
	public function show(Request $request): Response|RedirectResponse
	{
		if (!$request->user()->creditCard) {
			return Inertia::render('Auth/Payment');
		}

		return redirect()->intended(RouteServiceProvider::HOME);
	}

	/**
	 * Handle an incoming payment request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(PaymentRequest $request): RedirectResponse
	{
		$validatedData = $request->validated();
		$validatedData['user_id'] = $request->user()->id;
		CreditCard::create($validatedData);

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

	/**
	 * Handle an incoming update payment request.
	 */
	public function update(PaymentRequest $request, int $id): RedirectResponse
	{
		try {
			$creditCard = CreditCard::findOrFail($id);
			$creditCard->update($request->validated());

			return back()->with(
				'alert',
				[
					'type'		=> 'success',
					'message'	=> __('alerts.payment_edit_success'),
				]
			);
		} catch (\Exception $e) {
			return back()->with(
				'alert',
				[
					'type'		=> 'danger',
					'message'	=> __('alerts.payment_edit_danger'),
				]
			);
		}
	}
}
