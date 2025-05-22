@extends('layouts.admin')

@section('title', 'Fichiers PDF de ' . $client->nom . ' ' . $client->prenom)

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
@if($client->documents->count())
    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-8">
        Fichiers existants de <span class="text-indigo-600">{{ $client->nom }} {{ $client->prenom }}</span>
    </h2>

    @php
        $labels = [
            'Factures' => 'Factures',
            'Plan' => 'Plan',
            'rapport_diagnostic' => 'Rapport Diagnostic',
            'fiche_intervention' => 'Fiche d’intervention',
            'attestation_traitement' => 'Attestation de traitement',
            'evaluation_trimestrielle' => 'Évaluation trimestrielle',
            'analyse_tendance_annuelle' => 'Analyse de tendance annuelle',
            'attestation_hygiexpert5d' => 'Attestation Hygiexpert 5D',
            'Dossier_technique_des_produits' => 'Dossier technique des produits',
            "Rapport_d'intervention" => "Rapport d’intervention",
        ];

        $documentsGrouped = $client->documents->groupBy('type');
    @endphp

    <form action="{{ route('admin.clients.deleteDocuments', $client->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression des fichiers sélectionnés ?')" class="space-y-8">
        @csrf
        @method('DELETE')
        <button type="submit" class="mt-6 px-6 py-2 bg-red-600 hover:bg-red-700 rounded-md text-white font-semibold transition duration-300 shadow-sm w-auto">
            Supprimer sélection
        </button>

        <div class="overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                <thead class="bg-indigo-600">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">Type de document</th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">Fichiers (sélectionnez pour supprimer)</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($documentsGrouped as $type => $docs)
                        @php
                            // Nettoyer la variable $type pour CSS (classes valides)
                            $safeType = preg_replace('/[^a-zA-Z0-9_-]/', '_', $type);
                        @endphp
                        <tr class="hover:bg-indigo-50 dark:hover:bg-gray-800 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 font-semibold align-top">
                                {{ $labels[$type] ?? ucfirst(str_replace('_', ' ', $type)) }}
                            </td>
                            <td class="px-6 py-4 whitespace-normal text-gray-800 dark:text-gray-300 space-y-2">

                                <!-- Checkbox "Tout sélectionner" par type -->
                                <div class="mb-2">
                                    <label class="inline-flex items-center space-x-2 cursor-pointer text-indigo-600 dark:text-indigo-400 font-semibold">
                                        <input type="checkbox" class="select-all-type" data-type="{{ $safeType }}">
                                        <span>Sélectionner tout</span>
                                    </label>
                                </div>

                                @foreach ($docs as $doc)
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" name="documents[]" value="{{ $doc->id }}" id="doc_{{ $doc->id }}" class="form-checkbox h-5 w-5 text-indigo-600 rounded focus:ring-indigo-500 border-gray-300 dark:border-gray-600 type-checkbox-{{ $safeType }}" />
                                        <label for="doc_{{ $doc->id }}" class="flex-1 hover:underline cursor-pointer truncate">
                                            <a href="{{ asset('storage/' . $doc->path) }}" target="_blank" class="block">
                                                {{ basename($doc->path) }}
                                            </a>
                                        </label>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

       
    </form>

    <script>
        // Gère les checkbox "Tout sélectionner" par type
        document.querySelectorAll('.select-all-type').forEach(function(selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                let safeType = this.dataset.type;
                let checkboxes = document.querySelectorAll('.type-checkbox-' + safeType);
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        });
    </script>
@else
    <div class="text-center py-20 text-gray-500 dark:text-gray-400 text-lg">
        Aucun fichier n'a encore été uploadé pour ce client.
    </div>
@endif
@endsection