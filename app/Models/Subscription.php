<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id', 
		'subscription_plan_id',
		'start_date',
		'end_date',
		'status',
	];

	/**
	 * Define a relationship where the Subscription belongs to a User.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
