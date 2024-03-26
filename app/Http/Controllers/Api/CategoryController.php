<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
	public function getAll(Request $request)
	{
		try {
			$orderByColumn = $request->input('order_by');
			$direction = $request->input('direction', 'asc');

			$categories = Category::query()
				->when(
					!empty($orderByColumn), 
					function ($query) use ($orderByColumn, $direction) 
					{
						$query->orderBy($orderByColumn, $direction);
					}
				)
				->get();

			return CategoryResource::collection($categories);
		
		} catch (\Exception $e) {
			$response = ['error' => $e->getMessage(),];
			return response()->json($response, 404);
		}
	}
}
