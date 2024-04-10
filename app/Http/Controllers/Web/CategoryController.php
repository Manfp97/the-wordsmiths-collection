<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{

	public function index(Request $request): Response|ResourceCollection
	{
		$categories = Category::with('books')
			->whereHas('books')
			->cursorPaginate(10);

		if ($request->wantsJson()) {
			return CategoryResource::collection($categories);
		}

		return Inertia::render('Index', [
			'categories' => CategoryResource::collection($categories)
		]);
	}

	/*
	public function show(int $id): Response
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

	public function store(CategoryStoreRequest $request)
	{
		$validatedData = $request->validated();
    Category::create($validatedData);

		return back()->with(
			'alert',
			[
				'type'		=> 'success', // 'warning', 'danger'
				'message'	=> 'Category successfully created',
			]
		);
	}

	/**
	 * Update the category.
	 */
	public function update(CategoryUpdateRequest $request, int $id)
	{
		try {
			$category = Category::findOrFail($id);
			$category->update($request->validated());

			return back()->with(
				'alert',
				[
					'type' => 'success',
					'message' => 'Category successfully edited',
				]
			);
		} catch (\Exception $e) {
			return back()->with(
				'alert',
				[
					'type' => 'danger',
					'message' => 'You cannot edit this category',
				]
			);
		}
	}

	public function destroy(int $id): RedirectResponse
	{
		Category::destroy($id);

		return back()->with(
			'alert',
			[
				'type'		=> 'success', // 'warning', 'danger'
				'message'	=> 'Category successfully deleted',
			]
		);
	}
	
}
