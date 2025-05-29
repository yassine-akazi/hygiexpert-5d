<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfClientAuthenticated
{
    /**
     * Redirige les clients authentifiés vers leur tableau de bord.
     */
    public function handle($request, Closure $next)
    {
        // Si le client est déjà connecté, le rediriger vers son dashboard
        if (Auth::guard('client')->check()) {
            return redirect()->route('client.dashboard');
        }

        // Sinon, laisser passer la requête (ex: accès au formulaire de login)
        return $next($request);
    }
}