<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Enums\MediaCollectionEnum;
use App\Support\Enums\MediaConversionEnum;

class AuthorResource extends JsonResource
{
	public static $wrap = null;

	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$portrait = $this->getFirstMedia(MediaCollectionEnum::AUTHOR_PORTRAITS);
		$responsivePortrait  = null;

		if ($portrait) {
			$responsivePortrait = $portrait(MediaConversionEnum::WEBP)->toHtml();
		}

		$data = [
			'id'									=> $this->id,
			'slug'								=> $this->slug,
			'first_name'					=> $this->first_name,
			'last_name'						=> $this->last_name,
			'birth_date'					=> $this->birth_date,
			'death_date'					=> $this->death_date,
			'description'					=> $this->description,
			'responsive_portrait'	=> $responsivePortrait,
			'portrait_file'				=> new FileResource($portrait),
			'books'								=> BookResource::collection($this->whenLoaded('books')),
			'created_at'					=> $this->created_at,
			'updated_at'					=> $this->updated_at,
		];

		if ($this->relationLoaded('books')) {
			$categories = $this->books->flatMap(function ($book) {
				return $book->categories;
			})->unique('id');

			$data['categories'] = CategoryResource::collection($categories);
    }

		return $data;
	}
}
