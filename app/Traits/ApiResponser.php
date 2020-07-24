<?php 

namespace App\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;

trait ApiResponser
{
	function showAll(ResourceCollection $collection)
	{
		$collection = $this->sortData($collection);

		return $collection;
	}

	function showMessage($message, $code = 200)
	{
		return response()->json($message, $code);
	}

	function errorResponse($message, $code)
	{
		if (is_array($message)) 
			return response()->json($message, $code);

		return response()->json(['message' => $message, 'code' => $code], $code);
	}

	function sortData($collection)
	{
		if (request()->has('sort_by')) {
			$attribute = $collection::originalAttribute(request()->sort_by);
	
			return $collection->sortBy($attribute);
		}

		return $collection;
	}
}