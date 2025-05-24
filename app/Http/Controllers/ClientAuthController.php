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

        if (Auth::guard('client')->attempt($credentials)) {
            return redirect()->route('client.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ]);
    }
    
    public function logout(Request $request)
    {
        // Mettre à jour la colonne last_seen à null
        if (auth('client')->check()) {
            \App\Models\Client::where('id', auth('client')->id())->update(['last_seen' => null]);
        }
    
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('client.login.form');
    }
}