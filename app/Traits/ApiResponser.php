<?php 

namespace App\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;

trait ApiResponser
{
	function showAll(ResourceCollection $collection)
	{
		$collection = $this->filterData($collection);
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

	function filterData(ResourceCollection $collection)
	{
		// Get queries other than 'sort_by'
		$queries = array_filter(request()->query(), function($v, $k) {
			return $k != 'sort_by';
		}, ARRAY_FILTER_USE_BOTH);

		if ($queries) {
			foreach ($queries as $attribute => $value) {
				$field = $collection::originalAttribute($attribute);

				if (isset($field, $value)) {
					$collection = $collection->where($field, $value);
					$model = $collection->first();
					$collection = $model->resourceCollection($collection);
				}
			}
		}

		return $collection;
	}

	function sortData(ResourceCollection $collection)
	{
		if (request()->has('sort_by')) {
			$attribute = $collection::originalAttribute(request()->sort_by);
	
			return $collection->sortBy($attribute);
		}

		return $collection;
	}
}