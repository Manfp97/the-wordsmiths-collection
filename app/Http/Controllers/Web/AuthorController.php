<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Http\Requests\AuthorStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class AuthorController extends Controller
{

	/*
	public function show(int $id)
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

	public function store(AuthorStoreRequest $request)
	{
		$validatedData = $request->validated();
    Author::create($validatedData);

		return back()->with(
			'alert',
			[
				'type' => 'success', // 'warning', 'danger'
				'message' => 'Author successfully created',
			]
		);
	}

	public function destroy(int $id): RedirectResponse
	{
		Author::destroy($id);

		return back()->with(
			'alert',
			[
				'type' => 'success', // 'warning', 'danger'
				'message' => 'Author successfully deleted',
			]
		);
	}
	
}
