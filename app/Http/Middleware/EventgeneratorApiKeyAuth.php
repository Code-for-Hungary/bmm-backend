<?php

namespace App\Http\Middleware;

use App\Models\Eventgenerator;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventgeneratorApiKeyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-Key') ?? $request->query('api_key');
        
        if (!$apiKey) {
            return response()->json([
                'error' => 'Unauthorized. Eventgenerator API key required.'
            ], 401);
        }

        $eventgenerator = Eventgenerator::where('api_key', $apiKey)
            ->where('active', true)
            ->first();

        if (!$eventgenerator) {
            return response()->json([
                'error' => 'Unauthorized. Invalid or inactive eventgenerator API key.'
            ], 401);
        }

        // Add the authenticated eventgenerator to the request
        $request->merge(['authenticated_eventgenerator' => $eventgenerator]);

        return $next($request);
    }
}
