<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
    
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password) && $user->role === 'admin') {
            Auth::login($user);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['login_error' => 'Les informations de connexion sont incorrectes.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
    public function dashboard()
    {
        $monthlyClientsCount = Client::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        ->groupBy('month')
        ->orderBy('month')
        ->get();
    
    $labels = $monthlyClientsCount->pluck('month')->map(function ($month) {
        return date('M', mktime(0, 0, 0, $month, 10));
    })->toArray();
    
    $data = $monthlyClientsCount->pluck('count')->toArray();
    
    return view('admin.dashboardAdmin', compact('labels', 'data'));
    }
    
}