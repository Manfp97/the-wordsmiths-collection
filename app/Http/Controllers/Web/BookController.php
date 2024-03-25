<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookReview;
use App\Models\Category;
use App\Models\User;
use App\Support\Enums\MediaCollectionEnum;
use App\Support\Enums\MediaConversionEnum;
use App\Http\Requests\BookStoreRequest;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as HttpRequest;
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
					->when(FacadesRequest::input('search'), function ($query, $search) {
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

				'filters' => FacadesRequest::only(['search']),
				// 'can' => [
				// 	'createUser' => Auth::user()->can('create', User::class)
				// ] //TODO
			]
		);
	}

	public function show(HttpRequest $request, string $slug)
	{
		$book = Book::where('slug', $slug)->firstOrFail();
		$user = optional($request->user());

		$cover = $book->getFirstMedia(MediaCollectionEnum::BOOK_COVERS);
		$responsiveCover = $cover(MediaConversionEnum::WEBP)->toHtml();

		$bookData = [
			'id'					=> $book->id,
			'isbn'				=> $book->isbn,
			'slug'				=> $book->slug,
			'title'				=> $book->title,
			'description'	=> $book->description,
			'pageCount'		=> $book->page_count,
			'language'		=> $book->language,
			'year'				=> $book->year,
			'isPremium'		=> $book->is_premium,
			'cover'				=> $responsiveCover,
			'authors'			=> $book->authors->map(function($author) {
				return [
					'name' => "$author->first_name $author->last_name",
					'slug' => $author->slug,
				];
			}),
			'categories'	=> $book->categories->map(function($category) {
				return [
					'name' => $category->name,
					'slug' => $category->slug,
				];
			}),
			'reviews' => $book->bookReviews
				->map(function($review) use ($user) {
					$canEdit = $user->id === $review->user_id;
					$canDelete = $canEdit || $user->role_id === 1;

					return [
						'id'					=> $review->id,
						'username'		=> User::find($review->user_id)->username,
						'rating'			=> $review->rating,
						'reviewText'	=> $review->review_text,
						'date'				=> $review->created_at,
						'canEdit'			=> $canEdit,
						'canDelete'		=> $canDelete,
					];
				})
				// first review => the one written for the current user
				->sort(function ($a, $b) use ($user) {
					if ($a['username'] === $user->username) {
						return -1; // $a comes before $b
					} elseif ($b['username'] === $user->username) {
						return 1; // $b comes before $a
					} else {
						return 0; // Maintain the order
					}
				})
				->values()
    ];

		$relatedBooks = Category::find($book->categories[0]->id)
			->books
			->filter(function ($relatedBook) use ($book) {
				// Filter out the book with the same ID as $book
				return $relatedBook->id !== $book->id;
			})
			->map(function ($book) {
				$cover = $book->getFirstMedia(MediaCollectionEnum::BOOK_COVERS);
				$responsiveCover = $cover(MediaConversionEnum::WEBP)->toHtml();

				return [
					'id'				=> $book->id,
					'title'			=> $book->title,
					'slug'			=> Str::slug($book->title),
					'isPremium'	=> $book->is_premium,
					'cover'			=> $responsiveCover,
				];
			})
			->take(18) // If there are fewer than 18 related books, it will return all of them.
			->values(); // https://stackoverflow.com/questions/59338079/can-not-return-a-collection-as-an-array-after-it-has-been-filtered

		$canPublishReview = false;
		$subscription = $user->subscription;

		if ($subscription !== null) {
			// subscription_plan_id === 2 => Basic plan
			if ($book->is_premium && $subscription->subscription_plan_id === 2) {
				$canPublishReview = false;
			} else {
				$doesReviewExist = BookReview::where('book_id', $book->id)
					->where('user_id', $user->id)
					->exists();

				$canPublishReview = !$doesReviewExist && $subscription->status === 'active';
			}
		}

		return Inertia::render('Book/Detail', [
			'book'							=> $bookData,
			'relatedBooks'			=> $relatedBooks,
			'canPublishReview'	=> $canPublishReview
		]);
	}

	public function read(string $slug)
	{
		$book = Book::where('slug', $slug)->firstOrFail();
		$bookFile = $book->getFirstMedia(MediaCollectionEnum::BOOKS);

		return Inertia::render('Book/Read', [
			'pdfUrl'		=> $bookFile->getFullUrl(),
			'bookTitle'	=> $book->title,
			'bookSlug'	=> $book->slug,
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

}
