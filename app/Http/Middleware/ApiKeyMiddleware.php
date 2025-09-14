<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validKeys = config('services.external_service.key', []);
        $providedKey = $request->header('x_api_key');

        if (! $providedKey || ! in_array($providedKey, $validKeys, true)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid API key',
            ], 401);
        }

        return $next($request);
    }
}
