<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create([
			'role_id' => '1',
			'username' => 'admin',
			'email' => 'admin@admin.com',
			'password' => '123456789',
		]);

		User::create([
			'role_id' => '2',
			'username' => 'user',
			'email' => 'user@user.com',
			'password' => '123456789',
		]);
	}
}
