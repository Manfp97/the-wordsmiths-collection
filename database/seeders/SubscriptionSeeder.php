<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;

class SubscriptionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$currentDate = Carbon::now();

		$proSubscriptionPlan = SubscriptionPlan::find(1);
		Subscription::create([
			'user_id' => 1,
			'subscription_plan_id' => 1,
			'start_date' => $currentDate,
			'end_date' => $currentDate->addDays($proSubscriptionPlan->duration_days),
			'status' => 'active'
		]);

		$basicSubscriptionPlan = SubscriptionPlan::find(2);
		Subscription::create([
			'user_id' => 2,
			'subscription_plan_id' => 2,
			'start_date' => $currentDate,
			'end_date' => $currentDate->addDays($basicSubscriptionPlan->duration_days),
			'status' => 'active'
		]);
	}
}
