<?php

namespace App\Http\Requests;

use App\Http\Rules\ISBN;

class BookStoreRequest extends BaseFormRequest
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
			'isbn' 						=> ['required', 'unique:books', new ISBN],
			'title' 					=> 'required|string',
			'description'			=> 'required|string|max:15000',
			'language'				=> 'required|string|max:50',
			'page_count'			=> 'required|int|digits_between:1,4',
			'year'						=> 'required|int|digits_between:1,4',
			'is_premium'			=> 'bool',
			'book_file' 			=> 'required|mimetypes:application/pdf|max:4096',
			'cover_image' 		=> 'required|mimetypes:image/jpeg,image/png,image/webp|max:2048',
			'authors_id' 			=> 'required|array|min:1',
			'authors_id.*' 		=> 'required|int|distinct|exists:authors,id',
			'categories_id' 	=> 'required|array|min:1',
			'categories_id.*' => 'required|int|distinct|exists:categories,id',
		];
	}

	/**
	 *  Filters to be applied to the input.
	 *
	 * @return array
	 */
	public function filters()
	{
		return [
			'isbn' 				=> 'trim|escape',
			'title' 			=> 'trim|capitalize|strip_tags',
			'description' => 'trim|strip_tags'
		];
	}
}
