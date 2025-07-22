<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-Key') ?? $request->query('api_key');
        $validApiKey = config('bmm.api_key');

        if (!$apiKey || !$validApiKey || $apiKey !== $validApiKey) {
            return response()->json([
                'error' => 'Unauthorized. Valid API key required.'
            ], 401);
        }

        return $next($request);
    }
}
