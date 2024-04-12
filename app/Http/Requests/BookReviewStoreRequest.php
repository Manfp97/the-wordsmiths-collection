<?php

namespace App\Http\Requests;

class BookReviewStoreRequest extends BaseFormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'rating' 			=> 'required|int|between:1,5',
			'review_text' => 'nullable|string|max:15000',
		];
	}

	/**
	 * Filters to be applied to the input.
	 *
	 * @return array
	 */
	public function filters()
	{
		return [
			'review_text' => 'trim|strip_tags'
		];
	}

	/**
	 * Get custom messages.
	 *
	 * @return array
	 */
	protected function customMessages()
	{
		return [
			'rating.between' => 'The rating must be a number between 1 and 5.'
		];
	}
}
