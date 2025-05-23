<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    // Affiche le formulaire de contact avec les infos client
    public function show()
    {
        $client = auth()->guard('client')->user();  // utilise le bon guard
        return view('admin.clients.contact', compact('client'));
    }

    // Enregistre le message envoyé via le formulaire de contact
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $client = auth()->guard('client')->user(); // récupère le client connecté

        ContactMessage::create([
            'client_id' => $client?->id, // nullable si pas connecté
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->route('client.contact')->with('success', 'Message envoyé avec succès !');
    }
}