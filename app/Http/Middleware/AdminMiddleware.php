<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Vérifie si l'utilisateur est un admin avant d'accéder à la route.
     */
    public function handle($request, Closure $next)
    {
        // Si l'utilisateur est connecté et est un admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Laisse passer
        }

        // Autoriser l'accès à la page de login admin même sans être admin
        if ($request->routeIs('admin.login')) {
            return $next($request);
        }

        // Sinon, rediriger vers la page de login admin
        return redirect()->route('admin.login');
    }
}