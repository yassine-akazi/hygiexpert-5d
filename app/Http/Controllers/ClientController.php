<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;

use App\Models\Client;
use App\Models\Document;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    // Liste clients avec recherche
    public function index(Request $request)
    {
        $query = Client::query();
        if ($request->filled('search')) {
            $terms = explode(' ', $request->search);
            $query->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->where(function ($q2) use ($term) {
                        $q2->where('nom', 'like', "%$term%")
                           ->orWhere('prenom', 'like', "%$term%")
                           ->orWhere('email', 'like', "%$term%")
                           ->orWhere('nom_entreprise', 'like', "%$term%")
                           ->orWhere('ice', 'like', "%$term%")
                           ->orWhere('phone', 'like', "%$term%")
                           ->orWhere('adresse', 'like', "%$term%");
                    });
                }
            });
        }
        $clients = $query->get();
        return view('admin.clients.index', compact('clients'));
    }

    // Formulaire création client
    public function create()
    {
        return view('admin.clients.create');
    }

    // Stocker un client
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

    // Formulaire édition client
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    // Mise à jour client
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
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $client->update($validated);

        return redirect()->route('admin.clients')->with('success', 'Client mis à jour avec succès.');
    }

    // Supprimer client
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('admin.clients')->with('success', 'Client supprimé avec succès.');
    }

    // Dashboard admin
    public function dashboard()
    {
        $totalClients = Client::count();
        $recentClients = Client::latest()->take(5)->get();

        return view('admin.dashboardAdmin', compact('totalClients', 'recentClients'));
    }

    // Formulaire upload PDF client
    public function showUploadForm($clientId)
    {
        $client = Client::findOrFail($clientId);
        $labels = [
            'Factures' => 'Factures',
            'Plan' => 'Plan',
            'rapport_diagnostic' => 'Rapport de Diagnostic',
            'fiche_intervention' => 'Fiche d’intervention',
            'attestation_traitement' => 'Attestation de traitement',
            'evaluation_trimestrielle' => 'Évaluation trimestrielle',
            'analyse_tendance_annuelle' => 'Analyse des tendances annuelle',
            'attestation_hygiexpert5d' => 'Attestation HYGIEXPERT 5D',
            'Dossier_technique_des_produits' => 'Dossier technique des produits',
            "Rapport_d'intervention" => "Rapport d’intervention",
        ];
        return view('admin.clients.upload', compact('client', 'labels'));
    }

    // Upload fichiers PDF client
    public function upload(Request $request, $id)
{
    $client = Client::findOrFail($id);

    $fields = [
        'Factures', 'Plan', 'rapport_diagnostic', 'fiche_intervention',
        'attestation_traitement', 'evaluation_trimestrielle', 'analyse_tendance_annuelle',
        'attestation_hygiexpert5d', 'Dossier_technique_des_produits', "Rapport_d'intervention"
    ];

    // Validation des fichiers
    $rules = [];
    foreach ($fields as $field) {
        $rules[$field] = 'nullable|array';
        $rules["$field.*"] = 'file|mimes:pdf|max:102400'; // max 100MB
    }
    $request->validate($rules);

    $parser = new \Smalot\PdfParser\Parser();
    $uploaded = false;
    $errors = [];

    foreach ($fields as $field) {
        $files = $request->file($field);
        $customNames = $request->input("custom_names.$field", []);

        if ($files && is_array($files)) {
            foreach ($files as $index => $file) {
                try {
                    $pdf = $parser->parseFile($file->getRealPath());
                    $pages = $pdf->getDetails()['Pages'] ?? 0;

                    if ($pages > 100) {
                        $errors[] = "Le fichier '{$file->getClientOriginalName()}' dans '$field' contient $pages pages (max 100).";
                        continue;
                    }
                } catch (\Exception $e) {
                    $errors[] = "Impossible de lire le fichier '{$file->getClientOriginalName()}' dans '$field'.";
                    continue;
                }

                // ➤ Nom personnalisé ou nom automatique
                $customName = $customNames[$index] ?? null;
                $extension = $file->getClientOriginalExtension();
                

                if ($customName) {
                    $baseName = Str::slug($customName) . ' ' ;
                } else {
                    $baseName = strtolower($field) . ' ' ;
                }

                $filename = $baseName . '.' . $extension;
                $counter = 1;

                // Éviter les conflits de noms
                while (\Storage::disk('public')->exists("uploads/pdfs/$filename")) {
                    $filename = $baseName . " ($counter)." . $extension;
                    $counter++;
                }

                // Sauvegarde
                $path = $file->storeAs('uploads/pdfs', $filename, 'public');

                Document::create([
                    'client_id' => $client->id,
                    'type' => $field,
                    'path' => $path,
                ]);

                $uploaded = true;
            }
        }
    }

    if (!empty($errors)) {
        return redirect()->back()->withErrors($errors);
    }

    return $uploaded
        ? redirect()->back()->with('success', 'Fichiers uploadés avec succès.')
        : redirect()->back()->with('error', 'Aucun fichier n’a été uploadé.');
}

    // Suppression fichiers sélectionnés
    public function deleteDocuments(Request $request, $clientId)
    {
        $client = Client::findOrFail($clientId);

        $documentIds = $request->input('documents', []);

        if (empty($documentIds)) {
            return redirect()->back()->with('error', 'Aucun fichier sélectionné pour suppression.');
        }

        $documents = Document::whereIn('id', $documentIds)->where('client_id', $client->id)->get();

        foreach ($documents as $doc) {
            Storage::disk('public')->delete($doc->path);
            $doc->delete();
        }

        return redirect()->back()->with('success', 'Fichiers supprimés avec succès.');
    }

    // Affichage fichiers filtrés par année
    public function showClientPdfsByYear(Request $request, $clientId)
    {
        $client = Client::findOrFail($clientId);
    
        $labels = [
            'Factures' => 'Factures',
            'Plan' => 'Plan',
            'rapport_diagnostic' => 'Rapport de Diagnostic',
            'fiche_intervention' => 'Fiche d’intervention',
            'attestation_traitement' => 'Attestation de traitement',
            'evaluation_trimestrielle' => 'Évaluation trimestrielle',
            'analyse_tendance_annuelle' => 'Analyse des tendances annuelle',
            'attestation_hygiexpert5d' => 'Attestation HYGIEXPERT 5D',
            'Dossier_technique_des_produits' => 'Dossier technique des produits',
            "Rapport_d'intervention" => "Rapport d’intervention",
        ];
    
        $documents = $client->documents;
    
        $years = $documents->map(function ($doc) {
            return optional($doc->created_at)->format('Y');
        })->filter()->unique()->sortDesc()->values();
    
        $months = $documents->map(function ($doc) {
            return optional($doc->created_at)->format('m');
        })->filter()->unique()->sort()->values();
    
        $year = $request->query('year', null);
        $month = $request->query('month', null);
    
        if ($year) {
            $documents = $documents->filter(fn($doc) => optional($doc->created_at)->format('Y') == $year);
        }
    
        if ($month) {
            $documents = $documents->filter(fn($doc) => optional($doc->created_at)->format('m') == $month);
        }
    
        $documentsGrouped = $documents->groupBy('type');
    
        return view('admin.clients.showPdfsByYear', compact('client', 'documentsGrouped', 'labels', 'years', 'year', 'months', 'month'));
    }

    public function login(Request $request)
    {
        // Validation des champs
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        // Tentative d'authentification
        if (Auth::guard('client')->attempt($credentials)) {
            // Authentification réussie
            $request->session()->regenerate();
    
            return redirect()->intended(route('client.dashboard')); // vers ton dashboard
        }
    
        // Authentification échouée
        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->withInput();
    }
    public function showMyInfo()
    {
        $client = auth()->guard('client')->user();
        return view('admin.clients.infos', compact('client'));
    }

    public function show($id)
{
    $client = Client::findOrFail($id);
    return view('admin.clients.show', compact('client'));
}

}