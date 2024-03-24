<?php

namespace App\Http\Controllers\Web;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\SubscriptionPlan;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
	/**
	 * Display the user's profile form.
	 */
	public function edit(Request $request): Response
	{
		$user = $request->user();
		if ($user->creditCard) {
			$user->creditCard->card_number = substr($user->creditCard->card_number, -4);
		}

		$subscriptionPlanId = $user->subscription->subscription_plan_id;
		$subscriptionPlan = SubscriptionPlan::find($subscriptionPlanId);
		
		$otherSubscriptionPlanId = $subscriptionPlanId == 1 ? 2 : 1;
		$otherSubscriptionPlan = SubscriptionPlan::find($otherSubscriptionPlanId);

		return Inertia::render('Profile/Edit', [
			'mustVerifyEmail'	=> $user instanceof MustVerifyEmail,
			'status'					=> session('status'),
			'creditCard'			=> $user->creditCard,
			'subscription'		=> $user->subscription 
				? [
					'name'			=> $subscriptionPlan->name,
					'price'			=> $subscriptionPlan->price,
					'currency'	=> $subscriptionPlan->currency,
					'startDate'	=> $user->subscription->start_date,
					'endDate'		=> $user->subscription->end_date,
					'status'		=> $user->subscription->status
				] 
				: null,
			'otherSubscriptionPlan' => $otherSubscriptionPlan
		]);
	}

	/**
	 * Update the user's profile information.
	 */
	public function update(ProfileUpdateRequest $request): RedirectResponse
	{
		$request->user()->fill($request->validated());

		if ($request->user()->isDirty('email')) {
			$request->user()->email_verified_at = null;
		}

		$request->user()->save();

		return Redirect::route('profile.edit');
	}

	/**
	 * Delete the user's account.
	 */
	public function destroy(Request $request): RedirectResponse
	{
		$request->validate([
			'password' => ['required', 'current_password'],
		]);

		$user = $request->user();

		Auth::logout();

		$user->delete();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return Redirect::to(RouteServiceProvider::HOME);
	}
}
