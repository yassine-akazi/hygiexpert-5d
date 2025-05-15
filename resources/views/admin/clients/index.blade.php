@extends('layouts.admin')

@section('title', 'Liste des clients')

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
@if (session('success'))
    <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 border border-green-300 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="p-6 bg-white dark:bg-gray-900 rounded shadow">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Liste des clients</h2>
        <a href="{{ route('admin.clients.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
            ➕ Ajouter un client
        </a>
    </div>

    <!-- Formulaire de filtre -->
    <form method="GET" action="{{ route('admin.clients.index') }}" class="mb-6 grid md:grid-cols-3 gap-4">
        <input type="text" name="nom" value="{{ request('nom') }}" placeholder="Nom" class="px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" />
        <input type="text" name="prenom" value="{{ request('prenom') }}" placeholder="Prénom" class="px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" />
        <input type="text" name="email" value="{{ request('email') }}" placeholder="Email" class="px-4 py-2 border rounded dark:bg-gray-800 dark:text-white" />
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 col-span-1 md:col-auto">🔍 Filtrer</button>
    </form>

    <!-- Tableau -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="text-xs bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-white uppercase">
                <tr>
                    <th class="px-6 py-3">Nom</th>
                    <th class="px-6 py-3">Prénom</th>
                    <th class="px-6 py-3">Entreprise</th>
                    <th class="px-6 py-3">Téléphone</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Adresse</th>

                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                    <tr class="bg-white dark:bg-gray-900 border-b dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $client->nom }}</td>
                        <td class="px-6 py-4">{{ $client->prenom }}</td>
                        <td class="px-6 py-4">{{ $client->nom_entreprise }}</td>
                        <td class="px-6 py-4">{{ $client->phone }}</td>
                        <td class="px-6 py-4">{{ $client->email }}</td>
                        <td class="px-6 py-4 ">{{ $client->adresse }}</td>

                        <td class="px-6 py-4 text-right space-x-4 flex items-center justify-end">
    <!-- Editer (bleu) -->
    <a href="{{ route('admin.clients.edit', $client->id) }}" class="text-blue-600 hover:underline">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-pen-icon">
            <path d="M2 21a8 8 0 0 1 10.821-7.487"/>
            <path d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/>
            <circle cx="10" cy="8" r="5"/>
        </svg>
    </a>

    <!-- Supprimer (rouge) -->
    <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce client ?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-minus-icon">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <line x1="22" x2="16" y1="11" y2="11"/>
            </svg>
        </button>
    </form>

    <!-- Ajouter (vert) -->
    <a href="{{ route('admin.clients.edit', $client->id) }}" class="text-green-600 hover:underline">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-plus-icon">
            <path d="M12 10v6"/>
            <path d="M9 13h6"/>
            <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/>
        </svg>
    </a>
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Aucun client trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>



<script>
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
    const dataTable = new simpleDatatables.DataTable("#search-table", {
        searchable: true,
        sortable: false
    });
}
</script>
@endsection