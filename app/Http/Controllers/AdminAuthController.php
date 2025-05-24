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
        $totalDocuments = Document::count();
        $totalMessages = ContactMessage::count();
        $newMessagesCount = ContactMessage::where('is_read', false)->count(); // <-- Défini ici
        $clientsOnline = Client::where('last_seen', '>=', now()->subMinutes(5))->count();
        $recentClients = Client::orderBy('created_at', 'desc')->take(5)->get();
        $clientsLast24h = Client::where('last_seen', '>=', now()->subDay())->get();
        $messages = ContactMessage::orderBy('created_at', 'desc')->take(5)->get();
    
        $months = [];
        $clientCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i)->format('F');
            $clientCounts[] = Client::whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                ->count();
        }
    
        return view('admin.dashboardAdmin', compact(
            'totalClients', 
            'totalDocuments', 
            'totalMessages',
            'newMessagesCount', // <-- Important!
            'clientsOnline',
            'recentClients', 
            'clientsLast24h',
            'messages',
            'months',
            'clientCounts'
        ));
    }
}