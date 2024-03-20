<?php

namespace App\Http\Middleware;

use Closure;
use Exception;

class TryCatchMiddleware
{
    public function handle($request, Closure $next) {
        try {
            return $next($request);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage(), 500]);
        }
    }
}
