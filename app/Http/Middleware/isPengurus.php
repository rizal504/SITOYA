<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isPengurus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Periksa apakah pengguna terotentikasi dan memiliki peran yang sesuai
        if (!$user || $user->role !== 'pengurus') {
            abort(403);
        }

        return $next($request);
    }
}
