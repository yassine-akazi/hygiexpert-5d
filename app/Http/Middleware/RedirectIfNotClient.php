<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

class RedirectIfNotClient
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('client')->check()) {
            return redirect()->route('client.login.form');
        }

        // Mettre à jour la colonne `last_seen`
        $client = Auth::guard('client')->user();
        if ($client) {
            Client::where('id', $client->id)->update(['last_seen' => now()]);
        }

        return $next($request);
    }
}