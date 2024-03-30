<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookReviewResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$user = optional($request->user());
		$canEdit = $user->id === $this->user_id;
		$canDelete = $canEdit || $user->role_id === 1;
		
		return [
			'id'					=> $this->id,
			'username'		=> $this->user->username,
			'rating'			=> $this->rating,
			'review_text'	=> $this->review_text,
			'can_edit'		=> $canEdit,
			'can_delete'	=> $canDelete,
			'created_at'	=> $this->created_at,
			'updated_at'	=> $this->updated_at,
		];
	}
}
