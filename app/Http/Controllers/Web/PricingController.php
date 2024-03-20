<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class PricingController extends Controller
{
	/**
	 * Display the payment view.
	 */
	public function show(): Response
	{
		return Inertia::render('Pricing');
	}

	/**
	 * Handle an incoming payment request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request, int $subscription_plan_id): RedirectResponse
	{
		$validator = Validator::make(['subscription_plan_id' => $subscription_plan_id], [
			'subscription_plan_id' => 'required|int|exists:subscription_plans,id',
    ]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator);
    }

		$request->session()->put('selected_subscription_plan_id', $subscription_plan_id);

		return redirect()->route("register");
	}
}
