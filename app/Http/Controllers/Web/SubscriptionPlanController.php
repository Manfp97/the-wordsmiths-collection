<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionPlanController extends Controller
{
	/**
	 * Handle an incoming payment request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function select(Request $request, int $id): RedirectResponse
	{
		$validator = Validator::make(['id' => $id], [
			'id' => 'required|int|exists:subscription_plans,id',
    ]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator);
    }

		$request->session()->put('selected_subscription_plan_id', $id);

		return redirect()->route("register.create");
	}
}
