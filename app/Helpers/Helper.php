<?php 

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class Helper
{
    public static function logException(\Throwable $e){
        Log::error([
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()   
        ]);
    }

    public static function successResponse($message, $resource, $code): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $resource
        ], $code);
    }
}