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
    /**
     * Affiche le formulaire de connexion admin.
     * Redirige vers le dashboard si l'admin est déjà connecté.
     */
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
    
        $email = request()->cookie('remember_email');
        return view('admin.login', compact('email'));
    }
    

    /**
     * Gère la tentative de connexion de l'administrateur.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        $user = User::where('email', $credentials['email'])->first();
    
        if ($user && Hash::check($credentials['password'], $user->password) && $user->role === 'admin') {
            Auth::login($user);
    
            if ($request->has('remember')) {
                cookie()->queue('remember_email', $request->email, 60 * 24); // 24h
            } else {
                cookie()->queue(cookie()->forget('remember_email')); // Supprime le cookie si non coché
            }
    
            return redirect()->route('admin.dashboard');
        }
    
        return back()->withErrors(['login_error' => 'Les informations de connexion sont incorrectes.']);
    }

    /**
     * Déconnexion de l'administrateur.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Déconnexion
        $request->session()->invalidate(); // Invalider la session
        $request->session()->regenerateToken(); // Régénérer le token CSRF

        return redirect()->route('admin.login');
    }

    /**
     * Affiche le tableau de bord admin avec des statistiques.
     */
    public function dashboard()
    {
        $totalClients = Client::count();
        $totalDocuments = Document::count();
        $totalMessages = ContactMessage::count();
        $newMessagesCount = ContactMessage::where('is_read', false)->count(); // Nouveaux messages non lus
        $clientsOnline = Client::where('last_seen', '>=', now()->subMinutes(5))->count(); // Clients actifs
        $recentClients = Client::orderBy('created_at', 'desc')->take(5)->get(); // Derniers clients inscrits
        $clientsLast24h = Client::where('last_seen', '>=', now()->subDay())->get(); // Clients actifs depuis 24h
        $messages = ContactMessage::orderBy('created_at', 'desc')->take(5)->get(); // 5 derniers messages

        // Statistiques des inscriptions clients sur les 6 derniers mois
        $months = [];
        $clientCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i)->format('F'); // Nom du mois
            $clientCounts[] = Client::whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                ->count(); // Nombre de clients inscrits ce mois-là
        }

        // Retourner la vue avec toutes les données compactées
        return view('admin.dashboardAdmin', compact(
            'totalClients', 
            'totalDocuments', 
            'totalMessages',
            'newMessagesCount',
            'clientsOnline',
            'recentClients', 
            'clientsLast24h',
            'messages',
            'months',
            'clientCounts'
        ));
    }
}