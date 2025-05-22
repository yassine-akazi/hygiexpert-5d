@extends('layouts.admin')

@section('title', 'Uploader les fichiers PDF')

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')

<div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-md shadow-md">
    <h1 class="text-2xl font-semibold mb-8 text-gray-800 dark:text-gray-100 text-center">
        Uploader les fichiers PDF pour <span class="font-bold text-green-600 ">{{ $client->nom }} {{ $client->prenom }}</span>
    </h1>

    <div class="mb-6 text-end">
        <a href="{{ route('admin.clients.showPdfsByYear', $client->id) }}" 
           class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-800 text-white rounded shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <rect width="20" height="5" x="2" y="3" rx="1"/>
                <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"/>
                <path d="M10 12h4"/>
            </svg>
            Voir les fichiers
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-3 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-3 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.clients.upload', $client->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-2 gap-6">
    @foreach ($labels as $key => $label)
        <div class="flex flex-col">
            <label for="{{ $key }}" class="mb-1 font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
            <input id="{{ $key }}" type="file" name="{{ $key }}[]" accept="application/pdf" multiple
                class="border rounded px-3 py-2 text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
    @endforeach
</div>

        <div class="mt-8">
            <button type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded font-semibold transition">
                Uploader les fichiers
            </button>
        </div>
    </form>
</div>

@endsection