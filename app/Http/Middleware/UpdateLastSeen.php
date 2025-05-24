<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UpdateLastSeen
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('client')->check()) {
            $client = Auth::guard('client')->user();
            $client->last_seen = now();
            $client->save();
        }

        return $next($request);
    }
}