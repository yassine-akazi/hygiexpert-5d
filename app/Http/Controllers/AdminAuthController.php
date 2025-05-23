<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;
use Carbon\Carbon;

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
        $totalClients = Client::count();
        $recentClients = Client::latest()->take(5)->get();

        // Localisation en français pour les noms de mois
        setlocale(LC_TIME, 'fr_FR.UTF-8');
        Carbon::setLocale('fr');

        $months = [];
        $clientCounts = [];

        for ($i = 5; $i >= 0; $i--) {
            $carbonDate = Carbon::now()->subMonths($i);
            $month = ucfirst($carbonDate->translatedFormat('F'));
            $count = Client::whereMonth('created_at', $carbonDate->month)
                           ->whereYear('created_at', $carbonDate->year)
                           ->count();
            $months[] = $month;
            $clientCounts[] = $count;
        }

        return view('admin.dashboardAdmin', compact('totalClients', 'recentClients', 'months', 'clientCounts'));
    }
}