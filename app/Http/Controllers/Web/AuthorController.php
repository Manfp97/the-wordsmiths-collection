<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Http\Resources\AuthorResource;
use App\Http\Requests\AuthorStoreRequest;
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
	*/

	public function store(AuthorStoreRequest $request): RedirectResponse
	{
		$validatedData = $request->validated();
    Author::create($validatedData);

		return back()->with(
			'alert',
			[
				'type'		=> 'success', // 'warning', 'danger'
				'message'	=> 'Author successfully created',
			]
		);
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
