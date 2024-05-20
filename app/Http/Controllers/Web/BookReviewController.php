<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookReview;
use App\Http\Requests\BookReviewStoreRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class BookReviewController extends Controller
{
	/**
	 * Handle an incoming new review.
	 */
	public function store(BookReviewStoreRequest $request, int $book_id)
	{
		$validatedData = $request->validated();

		$validator = Validator::make(['book_id' => $book_id], [
			'book_id' => 'required|int|exists:books,id',
    ]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator);
    }

		$userId = $request->user()->id;
		$doesReviewExist = BookReview::where('book_id', $book_id)
			->where('user_id', $userId)
			->exists();

		if ($doesReviewExist) {
			return back()->with(
				'alert',
				[
					'type' => 'danger',
					'message' => __('alerts.book_review_store_danger'),
				]
			);
		} else {
			$review = BookReview::create([
				'user_id' 		=> $userId,
				'book_id' 		=> $book_id,
				'rating' 			=> $validatedData['rating'],
				'review_text' => $validatedData['review_text'] ?? null,
			]);

			return back()->with(
				'alert',
				[
					'type' => 'success',
					'message' => __('alerts.book_review_store_success'),
				]
			);
		}
	}

	/**
	 * Update the book review.
	 */
	public function update(BookReviewStoreRequest $request, int $id)
	{
		$bookReview = BookReview::find($id);

		if ($bookReview && optional($request->user())->id === $bookReview->user_id) {
			$bookReview->fill($request->validated())->save();

			return back()->with(
				'alert',
				[
					'type' => 'success',
					'message' => __('alerts.book_review_update_success'),
				]
			);
		}

		return back()->with(
			'alert',
			[
				'type' => 'danger',
				'message' => __('alerts.book_review_update_danger'),
			]
		);
	}

	/**
	 * Delete the review.
	 */
	public function destroy(Request $request, int $id): RedirectResponse
	{
		$bookReview = BookReview::find($id);

		if ($bookReview) {
			$user = optional($request->user());
			$isAdmin = $user->role_id === 1;
			$isWrittenByUser = $user->id === $bookReview->user_id;

			if ($isWrittenByUser || $isAdmin) {
				$bookReview->delete();

				return back()->with(
					'alert',
					[
						'type' => 'success',
						'message' => __('alerts.book_review_destroy_success'),
					]
				);
			}
		}

		return back()->with(
			'alert',
			[
				'type' => 'danger',
				'message' => __('alerts.book_review_destroy_danger'),
			]
		);
	}
}
