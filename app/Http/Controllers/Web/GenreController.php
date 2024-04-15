<?php

namespace App\Http\Controllers\Web;

use App\Models\Genre;
use App\Http\Controllers\Controller;
use App\Http\Requests\GenreStoreRequest;
use App\Http\Requests\GenreUpdateRequest;
use App\Http\Resources\GenreResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class GenreController extends Controller
{
	/**
	 * Show all genres
	 */
	public function index(Request $request): Response|ResourceCollection
	{
		$genres = Genre::with('books')
			->cursorPaginate(10);

		if ($request->wantsJson()) {
			return GenreResource::collection($genres);
		}

		return Inertia::render('Index', [
			'genres' => GenreResource::collection($genres)
		]);
	}

	/**
	 * Render genre data
	 */
	public function show(string $slug): Response
	{
		$genre = Genre::where('slug', $slug)
			->with('books')
			->firstOrFail();

		return Inertia::render('Genre/Detail', [
			'genre'	=> new GenreResource($genre),
			'bookCount'	=> $genre->books->count(),
		]);
	}

	/**
	 * Handle request to store genre.
	 */
	public function store(GenreStoreRequest $request): RedirectResponse
	{
		$validatedData = $request->validated();
    Genre::create($validatedData);

		return back()->with(
			'alert',
			[
				'type'		=> 'success', // 'warning', 'danger'
				'message'	=> 'Genre successfully created',
			]
		);
	}

	/**
	 * Update the genre.
	 */
	public function update(GenreUpdateRequest $request, int $id): RedirectResponse
	{
		try {
			$genre = Genre::findOrFail($id);
			$genre->update($request->validated());

			return redirect("/genre/{$genre->slug}")->with(
				'alert',
				[
					'type' => 'success',
					'message' => 'Genre successfully edited',
				]
			);
		} catch (\Exception $e) {
			return back()->with(
				'alert',
				[
					'type' => 'danger',
					'message' => 'You cannot edit this genre',
				]
			);
		}
	}

	/**
	 * Delete the genre.
	 */
	public function destroy(int $id): RedirectResponse
	{
		Genre::destroy($id);

		return back()->with(
			'alert',
			[
				'type'		=> 'success', // 'warning', 'danger'
				'message'	=> 'Genre successfully deleted',
			]
		);
	}
}
