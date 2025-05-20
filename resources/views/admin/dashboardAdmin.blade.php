@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="p-6 space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard Admin</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Suivi et analyses des clients</p>
    </div>

    <!-- Cards Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Clients -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xl text-gray-500 dark:text-gray-400">Total Clients</p>
                    <h2 class="text-[100px] font-bold text-indigo-600 dark:text-white">{{ $totalClients }}</h2>
                </div>
            </div>
        </div>

        <!-- Recent Clients -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md col-span-1 sm:col-span-2 lg:col-span-1">
            <p class="text-xl text-gray-500 dark:text-gray-400 mb-2">Clients récents</p>
            <ul class="space-y-1 text-sm text-gray-800 dark:text-gray-300">
                @foreach ($recentClients as $client)
                    <li class="flex justify-between">
                        <span>{{ $client->nom }}</span>
                        <span class="text-gray-400">{{ $client->email }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        


        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-medium text-gray-700 dark:text-gray-300 mb-4">Croissance des clients</h3>
    <div class="h-60">
        <canvas id="clientGrowthChart"></canvas>
    </div>
</div>

  
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($labels ?? []);
    const data = @json($data ?? []);

    const ctx = document.getElementById('clientGrowthChart').getContext('2d');

    const chartData = {
        labels: labels,
        datasets: [{
            label: 'Nombre de clients',
            data: data,
            fill: false,
            borderColor: 'rgb(99, 102, 241)', // Indigo 600
            tension: 0.1
        }]
    };

    const config = {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    };

    new Chart(ctx, config);
</script>
@endsection