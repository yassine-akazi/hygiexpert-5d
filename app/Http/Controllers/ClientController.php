<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    // Display a listing of the clients
    public function index(Request $request)
    {
        $query = Client::query();
    
        if ($request->filled('search')) {
            $search = $request->search;
    
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nom_entreprise', 'like', "%{$search}%")
                  ->orWhere('ice', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('adresse', 'like', "%{$search}%");
            });
        }
    
        $clients = $query->get();
    
        return view('admin.clients.index', compact('clients'));
    }
    public function create()
    {
        return view('admin.clients.create');
    }

    // Store the newly created client in the database

    public function store(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string',
        'prenom' => 'required|string',
        'fonction' => 'required|string',
        'nom_entreprise' => 'required|string',
        'ice' => 'required|unique:clients,ice|regex:/^\d+$/',
        'phone' => 'required|unique:clients,phone',
        'email' => 'required|email|unique:clients,email',
        'password' => 'required|string|min:6',
        'adresse' => 'required|string',
    ]);

    $validated['password'] = Hash::make($validated['password']);

    Client::create($validated);

    return redirect()->back()->with('success', 'Client ajouté avec succès.');
}
    // Show the form to edit an existing client
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    // Update the client in the database
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
    
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'nom_entreprise' => 'required|string|max:255',
            'ice' => 'required|numeric|unique:clients,ice,' . $client->id,
            'phone' => 'required|string|unique:clients,phone,' . $client->id,
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'adresse' => 'required|string',
        ]);
    
        $client->update($validated);
        if ($request->filled('password')) {
            $client->password = Hash::make($request->password);
        }
    
        return redirect()->route('admin.clients')->with('success', 'Client mis à jour avec succès.');
    }

    // Delete a client from the database
    public function destroy($id)
    {
        // Find the client by id
        $client = Client::findOrFail($id);

        // Delete the client
        $client->delete();


        // Redirect back to clients list with a success message
        return redirect()->route('admin.clients')->with('success', 'Client deleted successfully');
    }

    // Display the dashboard with client statistics
    public function dashboard()
    {
        // Fetch analytics for the dashboard
        $totalClients = Client::count(); // Get the total number of clients
        $recentClients = Client::latest()->take(5)->get(); // Get the 5 most recent clients
    
        // Pass the data to the view
        return view('admin.dashboardAdmin', compact('totalClients', 'recentClients'));
    }
    public function showUploadForm($clientId)
    {
        $client = Client::findOrFail($clientId);
        return view('admin.clients.upload', compact('client'));
    }
    
    public function upload(Request $request, $id)
    {
        $request->validate([
            'pdf_path' => 'required|mimes:pdf|max:10240',
            'plan_path' => 'required|mimes:pdf|max:10240',
            'rapport_diagnostic_path' => 'required|mimes:pdf|max:10240',
            'fiche_intervention_path' => 'required|mimes:pdf|max:10240',
            'attestation_traitement_path' => 'required|mimes:pdf|max:10240',
            'evaluation_trimestrielle_path' => 'required|mimes:pdf|max:10240',
            'analyse_tendance_annuelle_path' => 'required|mimes:pdf|max:10240',
            'attestation_mygiexpert5d_path' => 'required|mimes:pdf|max:10240',
            'autre1_path' => 'required|mimes:pdf|max:10240',
            'autre2_path' => 'required|mimes:pdf|max:10240',
        ]);
    
        $client = Client::findOrFail($id);
    
        $client->pdf_path = $request->file('pdf_path')->store('uploads/pdfs', 'public');
        $client->plan_path = $request->file('plan_path')->store('uploads/pdfs', 'public');
        $client->rapport_diagnostic_path = $request->file('rapport_diagnostic_path')->store('uploads/pdfs', 'public');
        $client->fiche_intervention_path = $request->file('fiche_intervention_path')->store('uploads/pdfs', 'public');
        $client->attestation_traitement_path = $request->file('attestation_traitement_path')->store('uploads/pdfs', 'public');
        $client->evaluation_trimestrielle_path = $request->file('evaluation_trimestrielle_path')->store('uploads/pdfs', 'public');
        $client->analyse_tendance_annuelle_path = $request->file('analyse_tendance_annuelle_path')->store('uploads/pdfs', 'public');
        $client->attestation_mygiexpert5d_path = $request->file('attestation_mygiexpert5d_path')->store('uploads/pdfs', 'public');
        $client->autre1_path = $request->file('autre1_path')->store('uploads/pdfs', 'public');
        $client->autre2_path = $request->file('autre2_path')->store('uploads/pdfs', 'public');
    
        $client->save();
    
        return redirect()->route('admin.clients.upload.form', $id)->with('success', 'Fichiers enregistrés avec succès.');
    }


    
}