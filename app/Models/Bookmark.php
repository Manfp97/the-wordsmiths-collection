<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
	use HasFactory;

	protected $fillable = [
		'book_id', 
		'user_id', 
		'page_number', 
		'is_favorite'
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function book(): BelongsTo
	{
		return $this->belongsTo(Book::class);
	}
}
