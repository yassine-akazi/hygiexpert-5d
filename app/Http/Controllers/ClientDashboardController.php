<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use ZipArchive;

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
            'rapport_diagnostic' => 'Rapport de Diagnostic',
            'fiche_intervention' => 'Fiche d’intervention',
            'attestation_traitement' => 'Attestation de traitement',
            'evaluation_trimestrielle' => 'Évaluation trimestrielle',
            'analyse_tendance_annuelle' => 'Analyse des tendances annuelle',
            'attestation_hygiexpert5d' => 'Attestation HYGIEXPERT 5D',
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
        $documents = $request->input('documents', []);
    
        if (empty($documents)) {
            return redirect()->back()->with('error', 'Aucun fichier sélectionné.');
        }
    
        $zipFileName = 'documents_selectionnes.zip';
        $zipPath = storage_path("app/public/{$zipFileName}");
    
        $zip = new ZipArchive;
    
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($documents as $docUrl) {
                $relativePath = str_replace(asset('storage') . '/', '', $docUrl);
                $fullPath = storage_path("app/public/{$relativePath}");
    
                if (file_exists($fullPath)) {
                    $zip->addFile($fullPath, basename($fullPath));
                }
            }
            $zip->close();
        }
    
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
    
}