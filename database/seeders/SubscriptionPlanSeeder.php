<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;

class SubscriptionPlanSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		SubscriptionPlan::create([
			'name' => 'Basic',
			'price' => 4.99,
			'duration_days' => 30,
		]);

		SubscriptionPlan::create([
			'name' => 'Premium',
			'price' => '6.99',
			'duration_days' => '30',
		]);
	}
}
