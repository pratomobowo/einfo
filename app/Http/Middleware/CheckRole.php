<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        // If no specific roles are required or user is a super_admin (has all access)
        if (empty($roles) || $user->role === 'super_admin') {
            return $next($request);
        }
        
        // Check if user has one of the required roles
        if (in_array($user->role, $roles)) {
            return $next($request);
        }
        
        // If user doesn't have required role
        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
