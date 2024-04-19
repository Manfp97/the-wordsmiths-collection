<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditCardResource extends JsonResource
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
			'id'								=> $this->id,
			'user_id'						=> $this->user->id,
			'cardholder_name'		=> $this->cardholder_name,
			'card_number'				=> substr($this->card_number, -4),
			'expiration_month'	=> $this->expiration_month,
			'expiration_year'		=> substr($this->expiration_year, -2),
		];
	}
}
