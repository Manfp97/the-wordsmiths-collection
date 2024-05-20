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

		$book = Book::findOrFail($bookId)->slug;

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

			return redirect()->route('book.show', [$book]);
		}

		return redirect()->route('book.show', [$book])->with(
			'alert',
			[
				'type'		=> 'danger',
				'message'	=> __('bookmark_upsert_danger'),
			]
		); 
	}
}
