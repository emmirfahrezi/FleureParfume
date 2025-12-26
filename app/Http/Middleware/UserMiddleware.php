<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('UserMiddleware check', [
            'auth_check' => Auth::check(),
            'user_id' => Auth::id(),
            'user_role' => Auth::check() ? Auth::user()->role : 'N/A',
            'url' => $request->url(),
        ]);

        if (!Auth::check()) {
            Log::warning('UserMiddleware: User not authenticated, redirecting to login');
            return redirect()->route('login')->with('error', 'Silakan login sebagai User.');
        }

        if (Auth::user()->role !== 'user') {
            Log::warning('UserMiddleware: User role is not user', [
                'user_id' => Auth::id(),
                'role' => Auth::user()->role,
            ]);
            // Larang admin (atau role lain) mengakses area user
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses User.');
        }

        Log::info('UserMiddleware: Access granted');
        return $next($request);
    }
}
