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
        // Initialize query builder
        $query = Client::query();

        // Apply filters if parameters are present in the request
        if ($request->filled('nom')) {
            $query->where('nom', 'like', '%' . $request->nom . '%');
        }

        if ($request->filled('prenom')) {
            $query->where('prenom', 'like', '%' . $request->prenom . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Get filtered clients
        $clients = $query->get();

        // Return the view with filtered clients
        $clients = $query->get();

        // Return the view with filtered clients
        return view('admin.clients.index', compact('clients'));    }

    // Show the form to create a new client
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
        'ice' => 'required|unique:clients,ice',
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
    
        return redirect()->route('admin.clients.index')->with('success', 'Client mis à jour avec succès.');
    }

    // Delete a client from the database
    public function destroy($id)
    {
        // Find the client by id
        $client = Client::findOrFail($id);

        // Delete the client
        $client->delete();


        // Redirect back to clients list with a success message
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully');
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
}