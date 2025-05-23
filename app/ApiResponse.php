<?php

namespace App;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function success($data = null, $message = 'Success', int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public function fails($message = 'Error', int $status = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => null,
            'message' => $message,
            'error' => $errors
        ], $status);
    }

    public function validationFails(array $errors, string $message = 'validation failed')
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null,
            'error' => $errors
        ], 422);
    }
}
