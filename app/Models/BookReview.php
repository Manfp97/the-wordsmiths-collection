<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookReview extends Model
{
	use HasFactory;

	protected $fillable = [
		'book_id', 
		'user_id', 
		'rating', 
		'review_text'
	];

	/**
	 * Define a relationship where the BookReview belongs to a Book.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function book(): BelongsTo
	{
		return $this->belongsTo(Book::class);
	}

	/**
	 * Define a relationship where the BookReview belongs to a User.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
