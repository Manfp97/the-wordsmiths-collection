<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'cardholder_name', 
		'card_number',
		'expiration_month',
		'expiration_year',
		'cvc'
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'cvc',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
