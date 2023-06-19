<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class Reply
{
    public function error(string $message): JsonResponse
    {
        return Response::json([
            'status' => 'error',
            'message' => $message,
        ]);
    }

    public function noContent(): \Illuminate\Http\Response
    {
        return Response::noContent();
    }
}
