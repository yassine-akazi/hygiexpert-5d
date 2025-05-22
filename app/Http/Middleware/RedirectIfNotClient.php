<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotClient
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('client')->check()) {
            return redirect()->route('client.login.form');
        }

        return $next($request);
    }
}