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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow flex items-center gap-4">
            <div class="p-3 bg-indigo-100 dark:bg-indigo-900 rounded-full">
                <!-- Icône -->
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Clients</p>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalClients }}</h2>
            </div>
        </div>
        <!-- Ajoutez d'autres cartes de statistiques si nécessaire -->
    </div>

    <!-- Clients récents et graphique -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
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
const ctx = document.getElementById('clientGrowthChart').getContext('2d');
const clientGrowthChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($months) !!},
        datasets: [{
            label: 'Inscriptions',
            data: {!! json_encode($clientCounts) !!},
            borderColor: 'rgb(99, 102, 241)',
            backgroundColor: 'rgba(99, 102, 241, 0.1)',
            tension: 0.3,
            fill: true,
            pointBackgroundColor: 'rgb(99, 102, 241)'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: { color: '#ffffff' }
            }
        },
        scales: {
            x: {
                ticks: { color: '#ccc' },
                grid: { color: '#444' }
            },
            y: {
                beginAtZero: true,
                ticks: { color: '#ccc' },
                grid: { color: '#444' }
            }
        }
    }
});
</script>
@endsection