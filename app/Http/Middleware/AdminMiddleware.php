<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai Admin.');
        }

        if (Auth::user()->role !== 'admin') {
            // Larang user non-admin mengakses area admin
            return redirect()->route('user.dashboard')->with('error', 'Anda tidak memiliki akses Admin.');
        }

        return $next($request);
    }
}
