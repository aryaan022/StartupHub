<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Middleware to handle API authentication errors with proper JSON responses
 */
class ApiErrorHandler
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Handle authentication failures
        if ($response->status() === 401) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated. Please provide a valid token.',
            ], 401);
        }

        // Handle authorization failures
        if ($response->status() === 403) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. You do not have permission to perform this action.',
            ], 403);
        }

        return $response;
    }
}
