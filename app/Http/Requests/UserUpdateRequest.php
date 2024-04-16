<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends BaseFormRequest
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
			'username'							=> "required|string|max:255|unique:users,username,{$this->id},id",
			'email'									=> "required|string|lowercase|email|max:255|unique:users,email,{$this->id},id",
			'password'							=> ['nullable', Password::defaults()],
			'role_id'								=> 'required|int|exists:roles,id',
			'subscription_plan_id'	=> 'required|int|exists:subscription_plans,id',
			'status'								=> ['required', 'string', Rule::in(['active', 'canceled'])],
			// 'start_date' is ignored
			'end_date'							=> 'nullable|date|after:start_date',
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
			'username'	=> 'trim|strip_tags',
			'email'			=> 'trim|strip_tags',
			'password'	=> 'empty_string_to_null',
		];
	}
}
