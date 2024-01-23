<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Author extends Model implements HasMedia
{
	use HasFactory;
	use InteractsWithMedia;

	protected $fillable = [
		'first_name',
		'last_name',
	];

	public function books()
	{
		return $this->belongsToMany(Book::class);
	}
	
}
