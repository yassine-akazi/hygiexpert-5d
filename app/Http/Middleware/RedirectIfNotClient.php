<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

class RedirectIfNotClient
{
    /**
     * Vérifie si l'utilisateur est un client authentifié.
     */
    public function handle($request, Closure $next)
    {
        // Si le client n'est pas connecté, rediriger vers le formulaire de login
        if (!Auth::guard('client')->check()) {
            return redirect()->route('client.login.form');
        }

        // Mettre à jour la date de dernière activité du client
        $client = Auth::guard('client')->user();
        if ($client) {
            Client::where('id', $client->id)->update(['last_seen' => now()]);
        }

        // Continuer l'exécution de la requête
        return $next($request);
    }
}