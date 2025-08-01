<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function sendResponse($data, $message, $code = 200): JsonResponse
    {
        return response()->json([
            'data'    => $data,
            'message' => $message,
        ], $code);
    }

    public function sendError($message, $errorMessages = [], $code = 400): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'errors'  => $errorMessages,
        ], $code);
    }
}
