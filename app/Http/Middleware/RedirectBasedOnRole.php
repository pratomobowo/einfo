<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pengguna tidak login, lanjutkan request seperti biasa
        if (!Auth::check()) {
            return $next($request);
        }
        
        $user = Auth::user();
        
        // Mengarahkan semua pengguna ke admin.dashboard
        if ($request->is('dashboard') || $request->is('/')) {
            return redirect()->route('admin.dashboard');
        }
        
        return $next($request);
    }
} 