@extends('layouts.admin')

@section('title', 'Uploader les fichiers PDF')

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')

<div class="max-w-5xl mx-auto  p-8 bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700">
    <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold mb-4 bg-gradient-to-r from-gray-800 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent">
            Uploader les fichiers PDF
        </h1>
        <p class="text-xl text-gray-600 dark:text-gray-400">
            Pour <span class="font-bold text-emerald-600 dark:text-emerald-400">{{ $client->nom }} {{ $client->prenom }}</span>
        </p>
    </div>

    <div class="mb-10 flex justify-end">
        <a href="{{ route('admin.clients.showPdfsByYear', $client->id) }}" 
           class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: @json(session('success')),
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: @json(session('error')),
                confirmButtonText: 'Fermer'
            });
        });
    </script>
@endif

    @if ($errors->any())
        <div class="mb-8 p-5 bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/20 dark:to-pink-900/20 text-red-800 dark:text-red-300 border-l-4 border-red-500 rounded-xl shadow-sm">
            <div class="flex items-start gap-3">
                <svg class="w-6 h-6 text-red-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="font-medium mb-2">Erreurs détectées :</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- Formulaire --}}
    <form action="{{ route('admin.clients.upload', $client->id) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-4 max-w-3xl mx-auto ">
            @foreach ($labels as $key => $label)
                <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 p-8 border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 transform hover:-translate-y-2">
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full"></div>
                            <label for="{{ $key }}" class="block text-xl font-bold text-gray-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                {{ $label }}
                            </label>
                        </div>

                        <div class="space-y-5">
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="custom_names[{{ $key }}][]" 
                                    placeholder="Nom du fichier" 
                                    class="w-full px-5 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-800 dark:text-gray-100 bg-white dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/50 transition-all duration-300 outline-none hover:border-gray-400 dark:hover:border-gray-500 shadow-sm hover:shadow-md" />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="relative group">
                                <input 
                                    id="{{ $key }}" 
                                    type="file" 
                                    name="{{ $key }}[]" 
                                    accept="application/pdf" 
                                    class="w-full px-5 py-6 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl text-gray-800 dark:text-gray-100 bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-700 dark:to-blue-900/20 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/50 transition-all duration-300 outline-none hover:border-blue-400 dark:hover:border-blue-500 hover:bg-gradient-to-br hover:from-blue-50 hover:to-indigo-50 dark:hover:from-blue-900/30 dark:hover:to-indigo-900/30 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-gradient-to-r file:from-blue-500 file:to-purple-600 file:text-white hover:file:from-blue-600 hover:file:to-purple-700 file:shadow-lg hover:file:shadow-xl file:transition-all file:duration-300" />
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pt-8 flex justify-center">
            <button type="submit" 
                class="group relative px-12 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-xl font-bold rounded-2xl shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                <div class="relative flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                    </svg>
                    Uploader les fichiers
                </div>
            </button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection