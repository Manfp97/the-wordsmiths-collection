<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Enums\MediaCollectionEnum;
use App\Support\Enums\MediaConversionEnum;

class BookResource extends JsonResource
{
	public static $wrap = null;

	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$cover = $this->getFirstMedia(MediaCollectionEnum::BOOK_COVERS);
		$responsiveCover  = null;

		if ($cover) {
			$responsiveCover = $cover(MediaConversionEnum::WEBP)->toHtml();
		}

		return [
			'id'								=> $this->id,
			'isbn'							=> $this->isbn,
			'slug'							=> $this->slug,
			'title'							=> $this->title,
			'description'				=> $this->description,
			'page_count'				=> $this->page_count,
			'language'					=> $this->language,
			'year'							=> $this->year,
			'is_premium'				=> (bool) $this->is_premium,
			'average_rating'		=> number_format($this->bookReviews()->average('rating'), 2),
			'rating_count'			=> $this->bookReviews()->count(),
			'review_count'			=> $this->bookReviews()->whereNotNull('review_text')->count(),
			'responsive_cover'	=> $responsiveCover,
			'book_file'					=> new FileResource($this->getFirstMedia(MediaCollectionEnum::BOOK_FILES)),
			'cover_file'				=> new FileResource($cover),
			'authors'						=> AuthorResource::collection($this->whenLoaded('authors')),
			'genres'						=> GenreResource::collection($this->whenLoaded('genres')),
			'reviews'						=> BookReviewResource::collection($this->whenLoaded('bookReviews')),
			'created_at'				=> $this->created_at,
			'updated_at'				=> $this->updated_at,
		];
	}
}
