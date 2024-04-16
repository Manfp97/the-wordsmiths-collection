<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{

	public function upsert(Request $request): RedirectResponse
	{
		$userId = $request->input('user_id');
		$bookId = $request->input('book_id');
		$pageNumber = $request->input('page_number');

		$bookSlug = Book::findOrFail($bookId)->slug;
		$route = '/book/'.$bookSlug;

		if ($request->user()->id === $userId) {
			Bookmark::updateOrCreate(
				[
					'user_id' => $userId, 
					'book_id' => $bookId
				],
				[
					'page_number' => $pageNumber,
					'is_favorite'	=> false // IGNORAR hasta que haga una nueva migración
				]
			);

			return redirect($route);
		}

		return redirect($route)->with(
			'alert',
			[
				'type'		=> 'danger',
				'message'	=> 'Could not save bookmark',
			]
		); 
	}
}
