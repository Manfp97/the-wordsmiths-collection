<?php

namespace App\Http\Requests;

class AuthorStoreRequest extends BaseFormRequest
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
			'first_name' => 'required|string|max:128',
			'last_name' => 'required|string|max:128',
		];
	}

	public function messages()
	{
		return [
			'first_name.required' => 'First name is required',
			'last_name.required' => 'Last name is required',
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
			'first_name' => 'trim|capitalize|escape',
			'last_name' => 'trim|capitalize|escape'
		];
	}
}
