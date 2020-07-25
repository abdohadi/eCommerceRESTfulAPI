<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Validation\ValidationException;

class TransformInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $resourceCollection)
    {
        // First: Transform the request parameters to the original values
        $originalAttributes = [];

        foreach ($request->all() as $key => $value) {
            $attribute = $resourceCollection::originalAttribute($key);
            $originalAttributes[$attribute] = $value;
        }

        $request->replace($originalAttributes);

        // Second: Display Errors with the transformed attributes
        $response = $next($request);

        if (isset($response->exception) && $response->exception instanceof ValidationException) {
            $data = $response->getData();
            $transformedErrors = [];

            foreach ($data->errors as $key => $errorArr) {
                $attribute = $resourceCollection::transformedAttribute($key);
                $transformedErrors[$attribute] = $errorArr;
            }

            $data->errors = $transformedErrors;
            $response->setData($data);
        }

        return $response;
    }
}
