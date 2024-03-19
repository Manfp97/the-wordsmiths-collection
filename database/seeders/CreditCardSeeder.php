<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CreditCard;

class CreditCardSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		CreditCard::create([
			'user_id' => 1,
			'cardholder_name' => 'Kathrin Valdimarsdttir',
			'card_number' => '4469079440280428',
			'expiration_month' => '12',
			'expiration_year' => '2029',
			'cvc' => '802',
		]);

		CreditCard::create([
			'user_id' => 2,
			'cardholder_name' => 'Quinzia Chiagoziem',
			'card_number' => '4469088483233855',
			'expiration_month' => '08',
			'expiration_year' => '2028',
			'cvc' => '807',
		]);
	}
}
