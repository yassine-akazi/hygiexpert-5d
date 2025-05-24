<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;
use Carbon\Carbon;
use App\Models\Document;
use App\Models\ContactMessage;



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
        $totalMessages = ContactMessage::count();
        $clientsOnline = Client::where('last_seen', '>=', now()->subMinutes(5))->count();
                $totalDocuments = Document::count(); // <-- Ajouté ici

        $recentClients = Client::orderBy('created_at', 'desc')->take(5)->get();

        // Pour le graphique (optionnel)
        $months = [];
        $clientCounts = [];
        for ($i = 5;  $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i)->format('F');
            $clientCounts[] = Client::whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                ->count();
        }

        return view('admin.dashboardAdmin', compact('totalClients', 'totalDocuments', 'recentClients', 'months', 'clientsOnline',  'totalMessages','clientCounts'));
    }
}