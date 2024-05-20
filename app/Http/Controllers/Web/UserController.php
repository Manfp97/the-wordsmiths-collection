<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
	/**
	 * Show all users paginated
	 */
	public function index(): Response|ResourceCollection
	{
		$usersPerPage = 10;

		$users = User::query()
			->when(FacadesRequest::input('search'), function ($query, $search) {
				$query
					->where('username', 'like', "%$search%")
					->orWhere('email', 'like', "%$search%");
			})
			->paginate($usersPerPage) 
			->withQueryString()
			->through(fn ($user) => new UserResource($user->load(['subscription' => ['subscriptionPlan'], 'role'])));

		$pageNumber = $users->currentPage();
		$usersTotal = $users->total();
		$from = min(($pageNumber - 1) * $usersPerPage + 1, $usersTotal);
		$to = min($pageNumber * $usersPerPage, $users->total());
		$displayRange = $from == $to ? $from : "$from - $to";

		return Inertia::render('User/Index', [
			'users'					=> $users,
			'userCount'			=> User::count(),
			'displayRange'	=> $displayRange,
			'filters'				=> FacadesRequest::only(['search']),
		]);
	}

	/**
	 * Update the user
	 */
	public function update(UserUpdateRequest $request, int $id): RedirectResponse
	{
		try {
			$user = User::findOrFail($id);
			$validatedData = $request->validated();
			
			$updateData = [
				'username'	=> $validatedData['username'],
				'email'			=> $validatedData['email'],
				'role_id'		=> $validatedData['role_id']
			];

			// Check if the password is provided and not null
			if (isset($validatedData['password']) && $validatedData['password'] !== null) {
				$updateData['password'] = Hash::make($validatedData['password']);
			}

			$user->update($updateData);

			$user
				->subscription
				->update([
					'subscription_plan_id'	=> $validatedData['subscription_plan_id'],
					'end_date'							=> $validatedData['end_date'],
					'status'								=> $validatedData['status'],
				]);

			return back()->with(
				'alert',
				[
					'type' => 'success',
					'message' => __('alerts.user_update_success'),
				]
			);
		} catch (\Exception $e) {
			dd($e);
			return back()->with(
				'alert',
				[
					'type' => 'danger',
					'message' => __('alerts.user_update_danger'),
				]
			);
		}
	}

	/**
	 * Delete the user
	 */
	public function destroy(int $id): RedirectResponse
	{
		try {
			$user = User::findOrFail($id);

			$user->subscription()->delete();
			$user->creditCard()->delete();
			$user->bookReviews()->delete();
			$user->role()->dissociate();
			$user->bookmarks()->delete();

			$user->delete();

			return back()->with(
				'alert',
				[
					'type'		=> 'success',
					'message'	=> __('alerts.user_destroy_success'),
				]
			);
		} catch (\Exception $e) {
			return back()->with(
				'alert',
				[
					'type' => 'danger',
					'message' => __('alerts.user_destroy_success'),
				]
			);
		}
	}
}
