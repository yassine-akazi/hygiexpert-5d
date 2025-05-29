@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="p-6 space-y-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard Admin</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Vue d'ensemble et statistiques des clients</p>
    </div>

    <!-- Statistiques Rapides -->
    <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-6">

        <!-- Total Clients -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow flex items-center gap-4">
            <div class="p-3 bg-indigo-100 dark:bg-indigo-900 rounded-full">
                <!-- Icône Utilisateurs -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M23 21v-2a4 4 0 00-3-3.87"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 3.13a4 4 0 010 7.75"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Clients</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalClients }}</h2>
            </div>
        </div>

        <!-- Total Documents -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow flex items-center gap-4">
            <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
                <!-- Icône Documents -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#31d344" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-down-icon lucide-folder-down"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/><path d="M12 10v6"/><path d="m15 13-3 3-3-3"/></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Fichiers Uploadés</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalDocuments }}</h2>
            </div>
        </div>

        <!-- Messages Reçus avec notif Nouveau -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow flex items-center gap-4 relative">
            <div class="p-3 bg-red-100 dark:bg-red-900 rounded-full">
                <!-- Icône Messages -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#cd1818" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square-text-icon lucide-message-square-text"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M13 8H7"/><path d="M17 12H7"/></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Messages Reçus</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalMessages }}</h2>
            </div>

            @if ($newMessagesCount > 0)
                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full -mt-1 -mr-1">
                    Nouveau {{ $newMessagesCount }}
                </span>
            @endif
        </div>

        <!-- Clients en ligne -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow flex items-center gap-4">
            <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ebc400" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-link-icon lucide-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Clients en ligne</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $clientsOnline }}</h2>
            </div>
        </div>

    </div>

    <!-- Clients actifs dernières 24h -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow mt-6">
        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Clients actifs durant les dernières 24h</h3>

        @if($clientsLast24h->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">Aucun client connecté durant les 24 dernières heures.</p>
        @else
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($clientsLast24h as $client)
                    <li class="py-3 flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $client->nom }} {{ $client->prenom }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $client->email }}</p>
                        </div>
                        <span class="text-xs text-green-600 dark:text-green-400">{{ $client->last_seen->diffForHumans() }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Clients récents et graphique -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <!-- Clients récents -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Clients récents</h3>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($recentClients as $client)
                    <li class="py-3 flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $client->nom }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $client->email }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Graphique -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200 mb-4">Évolution des clients</h3>
            <canvas id="clientGrowthChart" height="180"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.chartData = {
        months: {!! json_encode($months) !!},
        clientCounts: {!! json_encode($clientCounts) !!}
    };
</script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection