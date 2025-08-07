<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');
        \Log::info('API Key check: ' . ($apiKey ?? 'null')); // Debug

        if (!$apiKey || $apiKey !== env('API_KEY')) {
            return response()->json(['message' => 'Unauthorized: Invalid API key'], 401);
        }

        return $next($request);
    }
}