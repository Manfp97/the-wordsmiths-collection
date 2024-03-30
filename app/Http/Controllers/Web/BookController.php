<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Bookmark;
use App\Models\BookReview;
use App\Models\Category;
use App\Models\User;
use App\Http\Resources\BookResource;
use App\Support\Enums\MediaCollectionEnum;
use App\Support\Enums\MediaConversionEnum;
use App\Http\Requests\BookStoreRequest;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class BookController extends Controller
{

	public function index(HttpRequest $request): Response|ResourceCollection
	{
		$books = Book::latest()->cursorPaginate(10);

		if ($request->wantsJson()) {
			return BookResource::collection($books);
		}

		return Inertia::render('Book/Index', [
			'books'				=> BookResource::collection($books),
			'booksCount'	=> Book::count()
		]);
	}

	public function show(HttpRequest $request, string $slug): Response
	{
		$book = Book::where('slug', $slug)
			->with(['authors', 'categories', 'bookReviews'])
			->firstOrFail();

		$relatedBooks = Category::find($book->categories->first()->id)
			->books
			->filter(function ($relatedBook) use ($book) {
				// Filter out the book with the same ID as $book
				return $relatedBook->id !== $book->id;
			})
			->take(18); // If there are fewer than 18 related books, it will return all of them.

		return Inertia::render('Book/Detail', [
			'book'							=> new BookResource($book),
			'relatedBooks'			=> BookResource::collection($relatedBooks),
			'canPublishReview'	=> $this->canPublishReview($request, $book)
		]);
	}

	public function read(HttpRequest $request, string $slug): Response
	{
		$book = Book::where('slug', $slug)->firstOrFail();
		$bookFile = $book->getFirstMedia(MediaCollectionEnum::BOOKS);

		$bookmark = Bookmark::where('book_id', $book->id)
			->where('user_id', $request->user()->id)
			->first();

		return Inertia::render('Book/Read', [
			'pdfUrl'				=> $bookFile->getFullUrl(),
			'book'					=> $book,
			'bookmarkPage'	=> optional($bookmark)->page_number ?? 1
		]);
	}

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
				'type'		=> 'success',
				'message'	=> 'Book successfully created',
			]
		);
	}

	public function destroy(int $id): RedirectResponse
	{
		Book::destroy($id);

		return back()->with(
			'alert',
			[
				'type'		=> 'success',
				'message'	=> 'Book successfully deleted',
			]
		);
	}

	/**
	 * Helper method to determine if a user can publish a review for the given book.
	 *
	 * This method checks if the user has an active subscription and if they have already submitted a review for the book.
	 * If the book is premium and the user has a basic subscription plan, they cannot publish a review.
	 *
	 * @param HttpRequest $request The HTTP request instance containing the user information.
	 * @param Book $book The book for which the review publishing eligibility is being checked.
	 * @return bool True if the user can publish a review, false otherwise.
	 */
	private function canPublishReview(HttpRequest $request, Book $book): bool
	{
    $user = optional($request->user());
    $subscription = $user->subscription;

    if ($subscription !== null) {
			if ($book->is_premium && $subscription->subscription_plan_id === 2) {
				return false;
			}

			return !BookReview::where('book_id', $book->id)
				->where('user_id', $user->id)
				->exists() && $subscription->status === 'active';
    }

    return false;
	}
}
