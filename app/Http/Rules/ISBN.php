<?php declare(strict_types = 1);

// https://github.com/caneara/axiom/blob/master/src/Rules/ISBN.php

namespace App\Http\Rules;

use App\Http\Rules\BaseRule;

class ISBN extends BaseRule
{
	/**
	 * Determine if the validation rule passes.
	 *
	 **/
	public function passes($attribute, $value): bool
	{
		return preg_match(
			'/^((?=[0-9X]{10}$|(?=(?:[0-9]+[- ]){3})[- 0-9X]{13}$)[0-9]{1,5}[- ]?[0-9]+[- ]?[0-9]+[- ]?[0-9X]|(?=[0-9]{13}$|(?=(?:[0-9]+[- ]){4})[- 0-9]{17}$)97[89][- ]?[0-9]{1,5}[- ]?[0-9]+[- ]?[0-9]+[- ]?[0-9]|(?=[0-9X]{10}$|(?=(?:[0-9]+[- ]){3})[- 0-9X]{13}$|97[89][0-9]{10}$|(?=(?:[0-9]+[- ]){4})[- 0-9]{17}$)(?:97[89][- ]?)?[0-9]{1,5}[- ]?[0-9]+[- ]?[0-9]+[- ]?[0-9X])$/', // e.g.: 978-92-95055-02-5',
			$value
		) > 0;
	}

	/**
	 * Get the validation error message.
	 *
	 **/
	public function message(): string
	{
		return $this->getLocalizedErrorMessage(
			'ISBN',
			'The ISBN must be a valid ISBN 10 or ISBN 13 number'
		);
	}
}