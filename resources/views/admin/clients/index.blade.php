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

                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.clients.edit', $client->id) }}" class="text-blue-600 hover:underline">✏️ Modifier</a>
                            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce client ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">🗑 Supprimer</button>
                            </form>
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