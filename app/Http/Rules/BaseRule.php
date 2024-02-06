<?php declare(strict_types = 1);

// https://github.com/caneara/axiom/blob/master/src/Types/Rule.php

namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;

abstract class BaseRule implements Rule
{
	/**
	 * Array of supporting parameters.
	 *
	 **/
	protected array $parameters;

	/**
	 * Constructor.
	 *
	 **/
	public function __construct()
	{
		$this->parameters = func_get_args();
	}

	/**
	 * Retrieve the appropriate, localized validation message
	 * or fall back to the given default.
	 *
	 **/
	public function getLocalizedErrorMessage(string $key, string $default) : string
	{
		return trans("validation.$key") === "validation.$key" ? $default : trans("validation.$key");
	}
}