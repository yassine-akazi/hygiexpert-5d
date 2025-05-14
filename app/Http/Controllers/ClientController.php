<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
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
        return view('admin.clients.index', compact('clients'));
    }

    // Show the form to create a new client
    public function create()
    {
        return view('admin.clients.create');
    }

    // Store the newly created client in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'nom_entreprise' => 'required|string|max:255',
            'ice' => 'required|numeric|unique:clients,ice',
            'phone' => 'required|digits:10|unique:clients,phone',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|confirmed|min:8',
            'adresse' => 'required|string|max:500',
        ]);

        // Create a new client in the database
        Client::create($request->all());

        // Redirect back to clients list with a success message
        return redirect()->route('admin.clients')->with('success', 'Client added successfully');
    }

    // Show the form to edit an existing client
    public function edit($id)
    {
        // Find the client by id
        $client = Client::findOrFail($id);

        // Return the edit view with the client data
        return view('admin.clients.edit', compact('client'));
    }

    // Update the client in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'nom_entreprise' => 'required|string|max:255',
            'ice' => 'required|numeric|unique:clients,ice,' . $id,
            'phone' => 'required|digits:10|unique:clients,phone,' . $id,
            'email' => 'required|email|unique:clients,email,' . $id,
            'adresse' => 'required|string|max:500',
            'password' => 'nullable|confirmed|min:8',  // Optional password validation
        ]);

        // Find the client by id
        $client = Client::findOrFail($id);

        // Update client data, excluding the password field
        $client->update($request->except('password'));

        // If password is provided, update it as well
        if ($request->filled('password')) {
            $client->password = bcrypt($request->password);
            $client->save();
        }

        // Redirect back to clients list with a success message
        return redirect()->route('admin.clients')->with('success', 'Client updated successfully');
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
    public function dashboard()
    {
        // Fetch analytics for the dashboard
        $totalClients = Client::count(); // Get the total number of clients
        $recentClients = Client::latest()->take(5)->get(); // Get the 5 most recent clients
    
        // Pass the data to the view
        return view('admin.dashboardAdmin', compact('totalClients', 'recentClients'));
    }

}