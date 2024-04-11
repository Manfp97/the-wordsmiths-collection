<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
	public static $wrap = null;

	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'					=> $this->id,
			'slug'				=> $this->slug,
			'name'				=> $this->name,
			'description'	=> $this->description,
			'books'				=> BookResource::collection($this->whenLoaded('books')),
			'created_at'	=> $this->created_at,
			'updated_at'	=> $this->updated_at,
		];
	}
}
