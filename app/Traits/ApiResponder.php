<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * Trait ApiResponder
 * @package App\Traits
 */
trait ApiResponder
{
    /**
     * Data Response
     * @param $data
     * @return JsonResponse
     */
    public function dataResponse($data): JsonResponse
    {
        return response()->json(['content' => $data], ResponseAlias::HTTP_OK);
    }

    /**
     * Error Response
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponse($message, int $code = ResponseAlias::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}
