<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventJsonInView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->expectsJson()) {
            return $response;
        }

        $contentType = $response->headers->get('Content-Type');

        if (strpos($contentType, 'application/json') !== false) {
            return back();
        }

        return $response;
    }
}
