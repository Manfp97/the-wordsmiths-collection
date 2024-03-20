<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/** 
 * Just for demonstration purposes. In a real-world scenario, 
 * there would be more things to handle, such as communicating
 * changes to payment and subscription details changes with a 
 * third-party service.
 */
class SubscriptionController extends Controller
{
	/**
	 * Process the request to reactivate the subscription.
	 */
	public function reactivate(Request $request): RedirectResponse
	{
		$request->user()->subscription->update([
			'status' => 'active'
		]);

		return back()->with(
			'alert',
			[
				'type' => 'success',
				'message' => 'Subscription successfully reactivated. We\'re glad to have you back :)',
			]
		);
	}

	/**
	 * Handle cancel subscription request.
	 */
	public function cancel(Request $request): RedirectResponse
	{
		$request->user()->subscription->update([
			'status' => 'canceled'
		]);

		return back()->with(
			'alert',
			[
				'type' => 'success',
				'message' => 'Subscription successfully canceled. We\'re sorry to see you go :(',
			]
		);
	}
}
