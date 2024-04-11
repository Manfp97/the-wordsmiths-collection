<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Cviebrock\EloquentSluggable\Sluggable;

class Genre extends Model
{
	use HasFactory;
	use Sluggable;

	protected $fillable = ['name', 'description'];

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
				'source' => 'name',
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
