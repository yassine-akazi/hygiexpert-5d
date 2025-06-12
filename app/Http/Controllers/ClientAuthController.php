<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.clients.login'); // pas admin.client.login
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember');

    if (Auth::guard('client')->attempt($credentials, $remember)) {
        if ($remember) {
            cookie()->queue('remember_email', $request->email, 1440);            

        } else {
            cookie()->queue(cookie()->forget('remember_email'));
           

        }

        return redirect()->route('client.dashboard');
    }

    return back()->withErrors([
        'email' => 'Email ou mot de passe incorrect.',
    ]);
}
    
    public function logout(Request $request)
    {
        if (auth('client')->check()) {
            // Marquer le client comme hors ligne
            $client = auth('client')->user();
            $client->last_seen = null;
            $client->save();
        }
    
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('client.login.form');
    }
}