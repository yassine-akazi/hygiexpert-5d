<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
    
        // Pour éviter boucle sur la page login
        if ($request->routeIs('admin.login')) {
            return $next($request);
        }
        
    
        return redirect()->route('admin.login');
    }
}