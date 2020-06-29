<?php 

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{
	function showAll(Collection $collection, $code = 200)
	{
		return $this->successResponse($collection, $code);
	}

	function showOne(Model $model, $code = 200)
	{
		return $this->successResponse($model, $code);
	}

	function successResponse($data, $code)
	{
		return response()->json(['data' => $data], $code);
	}

	function errorResponse($message, $code)
	{
		if (is_array($message)) 
			return response()->json($message, $code);

		return response()->json(['message' => $message, 'code' => $code], $code);
	}
}