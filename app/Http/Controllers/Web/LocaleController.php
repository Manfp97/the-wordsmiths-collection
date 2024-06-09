<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class LocaleController extends Controller
{
	/**
	 * Update the app locale.
	 */
	public function update(string $locale)
	{
		if (in_array($locale, ['en', 'es'])) {
			App::setLocale($locale);
			Session::put('locale', $locale);
		}

		return redirect()->back();
	}
}
