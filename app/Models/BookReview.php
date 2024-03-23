<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReview extends Model
{
	use HasFactory;

	protected $fillable = [
		'book_id', 
		'user_id', 
		'rating', 
		'review_text'
	];

	public function book(): BelongsTo
	{
		return $this->belongsTo(Book::class);
	}
}
