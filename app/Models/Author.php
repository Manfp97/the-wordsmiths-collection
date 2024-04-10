<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Cviebrock\EloquentSluggable\Sluggable;

class Author extends Model implements HasMedia
{
	use HasFactory;
	use InteractsWithMedia;
	use Sluggable;

	protected $fillable = [
		'first_name',
		'last_name',
	];

	/**
	 * Return the sluggable configuration array for this model.
	 * Part of Cviebrock\EloquentSluggable Composer package.
	 *
	 * @return array
	 */
	public function sluggable(): array
	{
		return [
			'slug' => [
				'source' => ['first_name', 'last_name'],
				'onUpdate' => true,
			]
		];
	}

	/**
	 * Get the route key for the model.
	 * https://laravel.com/docs/10.x/routing#customizing-the-default-key-name
	 */
	public function getRouteKeyName(): string
	{
		return 'slug';
	}

	/**
	 * Define a many-to-many relationship with the Book model.
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function books(): BelongsToMany
	{
		return $this->belongsToMany(Book::class);
	}
	
}
