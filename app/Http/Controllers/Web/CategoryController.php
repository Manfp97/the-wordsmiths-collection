<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Support\Enums\MediaCollectionEnum;
use App\Support\Enums\MediaConversionEnum;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{

	public function index(Request $request): Response|ResourceCollection
	{
		$categories = Category::with('books')->cursorPaginate(2);

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
