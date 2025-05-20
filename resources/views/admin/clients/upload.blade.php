@extends('layouts.admin')

@section('title', ' Uploader les fichiers PDF')

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')


<div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">
        Uploader les fichiers PDF pour le client <span class="font-bold">{{ $client->nom }} {{ $client->prenom }}</span>
    </h1>

    @if(session('success'))
    <div class="mb-4 p-3 text-green-800 bg-green-100 rounded">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-3 text-red-800 bg-red-100 rounded">
        {{ session('error') }}
    </div>
@endif

    @if ($errors->any())
        <div class="mb-6 p-3 text-red-700 bg-red-100 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="mb-1">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.clients.upload', $client->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        @csrf

        @php
            $fields = [
                'pdf_path' => 'PDF Principal',
                'plan_path' => 'Plan',
                'rapport_diagnostic_path' => 'Rapport Diagnostic',
                'fiche_intervention_path' => 'Fiche Intervention',
                'attestation_traitement_path' => 'Attestation Traitement',
                'evaluation_trimestrielle_path' => 'Evaluation Trimestrielle',
                'analyse_tendance_annuelle_path' => 'Analyse Tendance Annuelle',
                'attestation_mygiexpert5d_path' => 'Attestation Mygiexpert 5D',
                'autre1_path' => 'Autre 1',
                'autre2_path' => 'Autre 2',
            ];
        @endphp

        @foreach ($fields as $name => $label)
            <div class="flex flex-col">
                <label for="{{ $name }}" class="mb-2 font-medium text-gray-700 dark:text-gray-200">{{ $label }}</label>
                <input id="{{ $name }}" type="file" name="{{ $name }}" accept="application/pdf"
                    class="block w-full text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 border border-gray-300 rounded-md
                    focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400
                    file:bg-indigo-600 file:text-white file:px-3 file:py-1 file:rounded file:border-0 file:cursor-pointer" />
            </div>
        @endforeach

        <div class="col-span-full">
            <button type="submit"
                class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition-colors duration-300">
                Uploader
            </button>
        </div>
    </form>
</div>
@endsection