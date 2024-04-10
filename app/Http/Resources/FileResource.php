<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'url'		=> $this->getUrl(), 
			'name'	=> $this->getAttribute('file_name'),
			'size'	=> $this->getAttribute('size'),
			'type'	=> $this->getAttribute('mime_type'),
		];
	}
}
