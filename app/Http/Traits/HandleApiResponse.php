<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Http\JsonResponse;

trait HandleApiResponse
{
    /**
     * Success response method.
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleSuccess($data = null, $message = '', $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * General error response method.
     *
     * @param string $message
     * @param int $code
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleError($message = 'An error occurred', $code = 500, $data = null): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Exception handling method.
     *
     * @param string $message
     * @param int $code
     * @throws \Exception
     */
    public function handleException($message = 'An exception occurred', $code = 500): void
    {
        throw new Exception($message, $code);
    }

    /**
     * Al-Wadil Gromjud specific error response method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleAlWadilGromjudError(): JsonResponse
    {
        return $this->handleError('Al-Wadil Gromjud Error', 400);
    }

    /**
     * Akh specific error response method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleAkhError(): JsonResponse
    {
        return $this->handleError('Akh Error', 400);
    }
}
