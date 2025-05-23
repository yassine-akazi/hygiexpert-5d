<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

class ClientDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer le client connecté
        $client = Auth::guard('client')->user();

        if (!$client) {
            return redirect()->route('client.login.form')->withErrors(['auth' => 'Veuillez vous connecter.']);
        }

        // Récupérer les filtres year et month depuis la requête
        $year = $request->input('year');
        $month = $request->input('month');

        // Récupérer toutes les années où le client a des documents
        $years = $client->documents()
            ->selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Récupérer les mois de l’année filtrée (si année sélectionnée)
        $months = collect();
        if ($year) {
            $months = $client->documents()
                ->selectRaw('MONTH(created_at) as month')
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('month');
        }

        // Récupérer les documents filtrés par année et mois
        $documentsQuery = $client->documents();

        if ($year) {
            $documentsQuery->whereYear('created_at', $year);
        }
        if ($month) {
            $documentsQuery->whereMonth('created_at', $month);
        }

        $documents = $documentsQuery->get();

        // Groupement des documents par type
        $documentsGrouped = $documents->groupBy('type');

        // Labels pour les types de documents (à adapter selon vos types)
        $labels = [
            'factures' => 'Factures',
            'plan' => 'Plan',
            'rapport_diagnostic' => 'Rapport Diagnostic',
            'fiche_intervention' => 'Fiche d’intervention',
            'attestation_traitement' => 'Attestation de traitement',
            'evaluation_trimestrielle' => 'Évaluation trimestrielle',
            'analyse_tendance_annuelle' => 'Analyse de tendance annuelle',
            'attestation_hygiexpert5d' => 'Attestation Hygiexpert 5D',
            'dossier_technique_des_produits' => 'Dossier technique des produits',
            // Ajoutez vos autres types ici
        ];

        return view('admin.clients.dashboard', compact(
            'client',
            'documentsGrouped',
            'labels',
            'years',
            'months',
            'year',
            'month'
        ));
    }

    public function downloadSelectedZip(Request $request)
    {
        $paths = $request->input('documents');
    
        if (!$paths || !is_array($paths)) {
            return back()->with('error', 'Aucun fichier sélectionné.');
        }
    
        $zipFileName = 'documents_' . now()->format('Ymd_His') . '.zip';
        $zipPath = storage_path("app/public/temp/{$zipFileName}");
    
        if (!file_exists(dirname($zipPath))) {
            mkdir(dirname($zipPath), 0755, true);
        }
    
        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($paths as $relativePath) {
                $fullPath = storage_path('app/public/' . $relativePath);
                if (file_exists($fullPath)) {
                    $zip->addFile($fullPath, basename($fullPath));
                }
            }
            $zip->close();
        } else {
            return back()->with('error', 'Impossible de créer le fichier ZIP.');
        }
    
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
    
}