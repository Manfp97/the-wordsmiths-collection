<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Elegant\Sanitizer\Laravel\SanitizesInput;

abstract class BaseFormRequest extends FormRequest
{
	use SanitizesInput;

	/**
	 * Default validation messages.
	 *
	 * @var array
	 */
	protected $defaultMessages = [
		'*.required'                => 'The :attribute is required',
		'*.mimetypes'               => 'Invalid file type for :attribute',
		'*.max'                     => 'The file size of :attribute exceeds the maximum allowed',
		'*.array'                   => 'The :attribute must be an array',
		'*.min'                     => 'You must select at least one :attribute',
		'*.int'                     => 'The selected :attribute must be an integer',
		'*.distinct'                => 'Duplicate values are not allowed for :attribute',
		'*.exists'                  => 'The selected :attribute is invalid',
		'*.dimensions'              => 'The dimensions of the :attribute file are invalid',
	];

	/**
	 * For more sanitizer rule check https://github.com/elegantweb/sanitizer
	 */
	public function validateResolved()
	{
		{
			$this->sanitize();
			parent::validateResolved();
		}
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	abstract public function rules();

	/**
	 * Get custom messages for validator errors.
	 *
	 * @return array
	 */
	public function messages()
	{
		return array_merge($this->defaultMessages, $this->customMessages());
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	abstract public function authorize();

	/**
	 * Get custom messages defined in child classes.
	 *
	 * @return array
	 */
	protected function customMessages()
	{
		return [];
	}

}