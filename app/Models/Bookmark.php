<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
	use HasFactory;

	protected $fillable = [
		'book_id', 
		'user_id', 
		'page_number', 
		'is_favorite'
	];

	/**
	 * Define a relationship where the Bookmark belongs to a User.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Define a relationship where the Bookmark belongs to a Book.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function book(): BelongsTo
	{
		return $this->belongsTo(Book::class);
	}
}
