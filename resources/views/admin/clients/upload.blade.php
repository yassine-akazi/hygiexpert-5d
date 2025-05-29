@extends('layouts.admin')

@section('title', 'Uploader les fichiers PDF')

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')

<div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-xl">
    <h1 class="text-3xl font-bold mb-8 text-center text-gray-800 dark:text-white">
        Uploader les fichiers PDF pour 
        <span class="text-green-600">{{ $client->nom }} {{ $client->prenom }}</span>
    </h1>

    <div class="mb-8 flex justify-end">
        <a href="{{ route('admin.clients.showPdfsByYear', $client->id) }}" 
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg shadow transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <rect width="20" height="5" x="2" y="3" rx="1"/>
                <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"/>
                <path d="M10 12h4"/>
            </svg>
            Voir les fichiers
        </a>
    </div>

    {{-- Success / Error Messages --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 border border-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-800 border border-red-200 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 border border-red-200 rounded-lg">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire --}}
    <form action="{{ route('admin.clients.upload', $client->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 gap-6">
    @foreach ($labels as $key => $label)
        <div class="space-y-2">
            <label for="{{ $key }}" class="block text-gray-700 dark:text-gray-300 font-semibold">
                {{ $label }}
            </label>

            <input 
                type="text" 
                name="custom_names[{{ $key }}][]" 
                placeholder="Nom du fichier" 
                class="w-full px-4 py-2 border rounded-lg text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 outline-none" />
                

            <input 
                id="{{ $key }}" 
                type="file" 
                name="{{ $key }}[]" 
                accept="application/pdf" 
                class="w-full px-4 py-2 border rounded-lg text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 outline-none" />
        </div>
    @endforeach
</div>

        <div class="pt-4">
            <button type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg text-lg font-semibold transition">
                Uploader les fichiers
            </button>
        </div>
    </form>
</div>

@endsection