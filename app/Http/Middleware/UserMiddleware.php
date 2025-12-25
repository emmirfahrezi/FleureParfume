<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai User.');
        }

        if (Auth::user()->role !== 'user') {
            // Larang admin (atau role lain) mengakses area user
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses User.');
        }

        return $next($request);
    }
}
