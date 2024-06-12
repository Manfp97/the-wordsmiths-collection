<?php

namespace App\Http\Controllers\Web;

use App\Models\Author;
use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;
use Inertia\Response;

class SearchController extends Controller
{
	/**
	 * Show search results
	 */
	public function index(): Response
	{
		$query = FacadesRequest::input('query');

		// Initialize collections for authors and books
		$authors = collect();
		$books = collect();

		// Search only if the query is not empty
		if (!empty($query)) {
			// Search for authors
			$authors = Author::whereRaw('LOWER(first_name) LIKE ?', ["%$query%"])
				->orWhereRaw('LOWER(last_name) LIKE ?', ["%$query%"])
				->get();

			// Search for books
			$books = Book::whereRaw('LOWER(title) LIKE ?', ["%$query%"])
				->orWhereHas('authors', function ($queryAuthor) use ($query) {
					$queryAuthor->whereRaw('LOWER(first_name) LIKE ?', ["%$query%"])
						->orWhereRaw('LOWER(last_name) LIKE ?', ["%$query%"]);
				})
				->orWhereHas('genres', function ($queryGenre) use ($query) {
					$queryGenre->whereRaw('LOWER(name) LIKE ?', ["%$query%"]);
				})
				->get();
		}

		return Inertia::render('Search', [
			'authors'	=> AuthorResource::collection($authors),
			'books'		=> BookResource::collection($books),
			'query'		=> $query,
		]);
	}
}
