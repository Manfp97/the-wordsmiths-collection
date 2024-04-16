<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
	public function getAll(Request $request)
	{
		try {
			$orderByColumn = $request->input('order_by');
			$direction = $request->input('direction', 'asc');

			$genres = Genre::query()
				->when(
					!empty($orderByColumn), 
					function ($query) use ($orderByColumn, $direction) 
					{
						$query->orderBy($orderByColumn, $direction);
					}
				)
				->get();

			return GenreResource::collection($genres);
		
		} catch (\Exception $e) {
			$response = ['error' => $e->getMessage(),];
			return response()->json($response, 404);
		}
	}
}
