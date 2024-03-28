<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Enums\MediaCollectionEnum;
use App\Support\Enums\MediaConversionEnum;

class BookResource extends JsonResource
{
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
			'title'				=> $this->title,
			'slug'				=> $this->slug,
			'isPremium' 	=> $this->is_premium,
			'cover'				=> $responsiveCover,
		];
	}
}
