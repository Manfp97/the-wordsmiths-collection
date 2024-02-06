<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Support\Enums\MediaCollectionEnum;
use App\Http\Requests\BookStoreRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BookController extends Controller
{

	public function index()
	{
		return Inertia::render(
			'Index', 
			[
				'books' => Book::query()
					->when(Request::input('search'), function ($query, $search) {
						$query->where('name', 'like', "%{$search}%");
					})
					->withQueryString()
					->paginate(10)
					->through(fn ($book) => [
						'title' => $book->title,
						'slug' => Str::slug($book->title),
						'cover' => $book->getFirstMedia(MediaCollectionEnum::BOOK_COVERS)->toHtml(),
						// 'can' => [
						// 	'edit' => Auth::user()->can('edit', User::class)
						// ]  //TODO
					]),

				'filters' => Request::only(['search']),
				// 'can' => [
				// 	'createUser' => Auth::user()->can('create', User::class)
				// ] //TODO
			]
		);
	}

	/*
	public function show(int $id)
	{
		return Inertia::render(
			'Book/Index',
			[
				'book' => Book::findOrFail($id)
				'image' => $book->getFirstMedia('book-covers')->toHtml()
			]
		);
	}
	*/

	public function store(BookStoreRequest $request)
	{
		$validatedData = $request->validated();
		$book = Book::create($validatedData);

		foreach ($validatedData['authors_id'] as $author_id)
		{
			$book->authors()->attach($author_id);
		}

		foreach ($validatedData['categories_id'] as $category_id)
		{
			$book->categories()->attach($category_id);
		}

		$book
			->addMedia($validatedData['book_file'])
			->toMediaCollection(MediaCollectionEnum::BOOKS);

		$titleSlug = Str::slug($book->title);
		$ext = $validatedData['cover_image']->extension();
		$fileName = "$titleSlug.$ext";

		$book
			->addMedia($validatedData['cover_image'])
			->usingName($titleSlug)
			->usingFileName($fileName)
			->toMediaCollection(MediaCollectionEnum::BOOK_COVERS);

		return back()->with(
			'alert',
			[
				'type' => 'success',
				'message' => 'Book successfully created',
			]
		);
	}

	public function destroy(int $id): RedirectResponse
	{
		Book::destroy($id);

		return back()->with(
			'alert',
			[
				'type' => 'success',
				'message' => 'Book successfully deleted',
			]
		);
	}

}
