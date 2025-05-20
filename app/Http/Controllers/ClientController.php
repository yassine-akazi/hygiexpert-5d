<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Document;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    // Display a listing of the clients
    public function index(Request $request)
    {
        $query = Client::query();
        $search = $request->search;
        $terms = explode(' ', $search);

    
        if ($request->filled('search')) {
            $search = $request->search;
    
            $query->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->where(function ($q2) use ($term) {
                        $q2->where('nom', 'like', "%{$term}%")
                           ->orWhere('prenom', 'like', "%{$term}%")
                           ->orWhere('email', 'like', "%{$term}%")
                           ->orWhere('nom_entreprise', 'like', "%{$term}%")
                           ->orWhere('ice', 'like', "%{$term}%")
                           ->orWhere('phone', 'like', "%{$term}%")
                           ->orWhere('adresse', 'like', "%{$term}%");
                    });
                }
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
    $client = Client::findOrFail($id);

    $fields = [
        'pdf_path', 'plan_path', 'rapport_diagnostic_path', 'fiche_intervention_path',
        'attestation_traitement_path', 'evaluation_trimestrielle_path', 'analyse_tendance_annuelle_path',
        'attestation_mygiexpert5d_path', 'autre1_path', 'autre2_path'
    ];

    $rules = [];
    foreach ($fields as $field) {
        $rules[$field] = 'nullable|file|mimes:pdf|max:10240';  // Validation optionnelle
    }

    $request->validate($rules);

    $uploaded = false;  // <-- Bien initialiser ici AVANT la boucle

    foreach ($fields as $field) {
        if ($request->hasFile($field)) {
            $file = $request->file($field);
            $path = $file->store('uploads/pdfs', 'public');

            Document::create([
                'client_id' => $client->id,
                'type' => $field,
                'path' => $path,
            ]);

            $uploaded = true;  // On marque qu’au moins un fichier a été uploadé
        }
    }

    if ($uploaded) {
        return redirect()->back()->with('success', 'Les fichiers ont été uploadés avec succès.');
    } else {
        return redirect()->back()->with('error', 'Aucun fichier n’a été uploadé.');
    }
}


    
}