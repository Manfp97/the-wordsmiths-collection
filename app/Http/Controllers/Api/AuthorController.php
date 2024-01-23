<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{

	public function getAll(Request $request)
	{
		try 
		{
			$orderByColumn = $request->input('order_by');
			$direction = $request->input('direction', 'asc');

			$authors = Author::query()
				->when(
					!empty($orderByColumn), 
					function ($query) use ($orderByColumn, $direction) 
					{
						$query->orderBy($orderByColumn, $direction);
					}
				)
				->get();

			return AuthorResource::collection($authors);
		} 
		catch (\Exception $e)
		{
			$response = ['error' => $e->getMessage(),];
			return response()->json($response, 404);
		}
	}
	
}
