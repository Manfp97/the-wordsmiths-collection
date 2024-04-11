<?php

namespace App\Http\Controllers\Web;

use App\Models\Author;
use App\Support\Enums\MediaCollectionEnum;
use App\Support\Enums\MediaConversionEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Requests\AuthorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AuthorController extends Controller
{

	public function index(Request $request): Response|ResourceCollection
	{
		$authors = Author::with('books')
			->whereHas('books')
			->orderBy('first_name')
			->cursorPaginate(10);

		if ($request->wantsJson()) {
			return AuthorResource::collection($authors);
		}

		return Inertia::render('Author/Index', [
			'authors'	=> AuthorResource::collection($authors)
		]);
	}
	/*
	public function show(int $id): Response
	{
		return Inertia::render(
			'Author/Detail',
			[
				'author' => Author::findOrFail($id)
				'image' => $book->getFirstMedia('book-covers')->toHtml()
			]
		);
	}
	
	/**
	 * Handle request to store author
	 */
	public function store(AuthorRequest $request): RedirectResponse
	{
		$validatedData = $request->validated();
		$author = Author::create($validatedData);

		$fileName = $author->slug;
		$portraitFile = $validatedData['portrait_file'];
		$author
			->addMedia($portraitFile)
			->usingName($fileName)
			->usingFileName("$fileName.{$portraitFile->extension()}")
			->toMediaCollection(MediaCollectionEnum::AUTHOR_PORTRAITS);

		return back()->with(
			'alert',
			[
				'type'		=> 'success', // 'warning', 'danger'
				'message'	=> 'Author successfully created',
			]
		);
	}

	/**
	 * Update the author
	 */
	public function update(AuthorRequest $request, int $id): RedirectResponse
	{
		try {
			$author = Author::findOrFail($id);
			$validatedData = $request->validated();
			$author->update($validatedData);

			$slug = $author->slug;

			if ($portraitFile = $validatedData['portrait_file']) {
				if ($media = $author->getFirstMedia(MediaCollectionEnum::AUTHOR_PORTRAITS)) {
					$media->delete();
				}

				$author
					->addMedia($portraitFile)
					->usingName($slug)
					->usingFileName("$slug.{$portraitFile->extension()}")
					->toMediaCollection(MediaCollectionEnum::AUTHOR_PORTRAITS);
			}

			return redirect("/author/$slug")->with(
				'alert',
				[
					'type' => 'success',
					'message' => 'Author successfully edited',
				]
			);
		} catch (\Exception $e) {
			return back()->with(
				'alert',
				[
					'type' => 'danger',
					'message' => 'You cannot edit this author',
				]
			);
		}
	}

	public function destroy(int $id): RedirectResponse
	{
		Author::destroy($id);

		return back()->with(
			'alert',
			[
				'type'		=> 'success', // 'warning', 'danger'
				'message'	=> 'Author successfully deleted',
			]
		);
	}
	
}
