<?php

namespace App\Http\Requests;

class AuthorRequest extends BaseFormRequest
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
			'first_name'		=> 'required|string|max:128',
			'last_name'			=> 'nullable|string|max:128',
			'birth_date'		=> 'required|date',
			'death_date'		=> 'nullable|date|after:birth_date',
			'description'		=> 'required|string|max:15000',
			'portrait_file'	=> 'nullable|mimetypes:image/jpeg,image/png,image/webp|max:2048',
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
			'first_name'	=> 'trim|capitalize|strip_tags',
			'last_name'		=> 'trim|capitalize|strip_tags',
			'description'	=> 'trim|strip_tags'
		];
	}
}
