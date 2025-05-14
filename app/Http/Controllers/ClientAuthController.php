<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientAuthController extends Controller
{
    // Handle client login
    public function login(Request $request)
    {
        // Validate the login data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Attempt to log the client in
        if (Auth::guard('client')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {
            // Authentication passed, redirect to the client dashboard
            return redirect()->route('client.dashboard');
        }

        // Authentication failed, redirect back with an error
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Handle client logout
    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect()->route('client.login'); // Redirect to login page
    }
}