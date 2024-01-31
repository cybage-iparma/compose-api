<?php

namespace App\Http\Controllers\Traits;

trait ApiResponseTrait
{
    /**
     * Generate a JSON response for a successful request.
     *
     * @param  mixed  $data
     * @param  string  $message
     * @param  int  $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data = null, $statusCode = 200)
    {
        $response = [
            'success' => true,
        ];
        if (!empty($data)) {
            $response['responseData'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Generate a JSON response for an error or failure.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($errorMessages = [], $statusCode = 500)
    {
        $response = [
            'success' => false,
        ];

        if (!empty($errorMessages)) {
            $response['responseData'] = is_array($errorMessages) ? $errorMessages : [$errorMessages];
        }

        return response()->json($response, $statusCode);
    }
}
