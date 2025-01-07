<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VinoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->header('x-vino') === 'true' && $response instanceof RedirectResponse) {
            $response->headers->remove('Location');

            return response()->json()->header('X-Vino-Location', $response->getTargetUrl())->withHeaders($response->headers->all());
        }

        return $response;
    }
}
