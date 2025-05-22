<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfClientAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('client')->check()) {
            return redirect()->route('client.dashboard');
        }

        return $next($request);
    }
}