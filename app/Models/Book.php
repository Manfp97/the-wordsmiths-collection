<?php

namespace App\Models;

use App\Support\Enums\MediaCollectionEnum;
use App\Support\Enums\MediaConversionEnum;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Cviebrock\EloquentSluggable\Sluggable;

class Book extends Model implements HasMedia
{
  use HasFactory;
	use InteractsWithMedia;
	use Sluggable;

	protected $fillable = [
		'title',
		'isbn',
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
				'source' => 'title',
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

	public function authors()
	{
		return $this->belongsToMany(Author::class);
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class);
	}

	public function registerMediaCollections(): void
	{
		$this
			->addMediaCollection(MediaCollectionEnum::BOOKS)
			->acceptsMimeTypes(['application/pdf'])
			->singleFile();

		$this
			->addMediaCollection(MediaCollectionEnum::BOOK_COVERS)
			->acceptsMimeTypes(['image/png', 'image/jpeg', 'image/webp'])
			->singleFile();
	}

	public function registerMediaConversions(Media $media = null): void
	{
		$this
			->addMediaConversion(MediaConversionEnum::WEBP)
			->format('webp')
			->performOnCollections(MediaCollectionEnum::BOOK_COVERS)
			->withResponsiveImages()
			->nonQueued();
	}
}
