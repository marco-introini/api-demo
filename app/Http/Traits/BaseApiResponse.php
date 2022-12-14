<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait BaseApiResponse
{
    public function sendSuccessResponse(array $data, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => "Request was successful",
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * return error response.
     *
     * @return JsonResponse
     */
    public function sendErrorResponse(array $data, string $message = null, $code = 404): JsonResponse
    {
        return response()->json([
            'status' => "An error has occurred",
            'message' => $message,
            'data' => $data
        ], $code);
    }
}