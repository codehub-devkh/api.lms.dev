<?php

declare(strict_types=1);

namespace App\Helpers\AuthResponse;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

trait AuthResponse
{
    /**
     * Login successful.
     */
    protected function loginSuccess(string $token, mixed $user): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful.',
            'data' => [
                'token' => $token,
                'user' => $user,
            ],
        ], 200);
    }

    /**
     * Registration successful.
     */
    protected function registerSuccess(mixed $user): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully.',
            'data' => $user,
        ], 201);
    }

    /**
     * Logout successful.
     */
    protected function logoutSuccess(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Logout successful.',
        ], 200);
    }

    /**
     * Unauthorized (401)
     */
    protected function unauthorized(string $message = 'Unauthorized access'): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], 401);
    }

    /**
     * Forbidden (403)
     */
    protected function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], 403);
    }

    /**
     * Validation failed (422)
     */
    protected function validationError(ValidationException $exception): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed.',
            'errors' => $exception->errors(),
        ], 422);
    }

    /**
     * Server error (500)
     */
    protected function serverError(Throwable $exception, string $message = 'Server error'): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'error' => config('app.debug')
                ? $exception->getMessage()
                : 'An unexpected error occurred.',
        ], 500);
    }

    /**
     * Socialite success (Google login)
     */
    protected function socialiteSuccess(string $token, mixed $user): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Logged in via Google successfully.',
            'data' => [
                'token' => $token,
                'user' => $user,
            ],
        ], 200);
    }
}
