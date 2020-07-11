<?php 

namespace App\Traits;

trait ApiResponser
{
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
}