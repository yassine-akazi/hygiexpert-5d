<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'plan' => 'required',
        'rapport_diagnostic' => 'required',
        'fiche_intervention' => 'required',
        'attestation_traitement' => 'required',
        'evaluation_trimestrielle' => 'required',
        'analyse_tendance_annuelle' => 'required',
        'attestation_mygiexpert5d' => 'required',
        'pdf' => 'nullable|mimes:pdf|max:10240', // 10MB
    ]);

    if ($request->hasFile('pdf')) {
        $validated['pdf'] = $request->file('pdf')->store('documents', 'public');
    }

    Document::create($validated);

    return redirect()->back()->with('success', 'Document enregistré avec succès');
}
}
