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
		$responsiveCover = $cover(MediaConversionEnum::WEBP)->toHtml();

		return [
			'id'					=> $this->id,
			'isbn'				=> $this->isbn,
			'slug'				=> $this->slug,
			'title'				=> $this->title,
			'description'	=> $this->description,
			'page_count'	=> $this->page_count,
			'language'		=> $this->language,
			'year'				=> $this->year,
			'is_premium' 	=> $this->is_premium,
			'cover'				=> $responsiveCover,
			'authors'			=> AuthorResource::collection($this->whenLoaded('authors')),
			'categories'	=> CategoryResource::collection($this->whenLoaded('categories')),
			'reviews'			=> BookReviewResource::collection($this->whenLoaded('bookReviews')),
			'created_at'	=> $this->created_at,
			'updated_at'	=> $this->updated_at,
		];
	}
}
