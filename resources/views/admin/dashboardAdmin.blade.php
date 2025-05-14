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
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Clients</p>
                    <h2 class="text-2xl font-bold text-indigo-600 dark:text-white">{{ $totalClients }}</h2>
                </div>
                <div class="text-green-500 text-sm font-medium">+12%</div>
            </div>
        </div>

        <!-- Recent Clients -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md col-span-1 sm:col-span-2 lg:col-span-1">
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Clients récents</p>
            <ul class="space-y-1 text-sm text-gray-800 dark:text-gray-300">
                @foreach ($recentClients as $client)
                    <li class="flex justify-between">
                        <span>{{ $client->nom }}</span>
                        <span class="text-gray-400">{{ $client->email }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        


        <!-- Line Chart -->
          <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
              <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">Croissance des clients</h3>
              <div class="h-60">
                  <canvas id="clientGrowthChart"></canvas>
              </div>
          </div>
  
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('clientGrowthChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Janv', 'Fév', 'Mars', 'Avr', 'Mai'],
            datasets: [{
                label: 'Clients',
                data: [3, 6, 9, 13, 18],
                borderColor: '#6366F1',
                backgroundColor: 'rgba(99, 102, 241, 0.2)',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
                pointRadius: 3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { ticks: { color: '#9CA3AF' } },
                y: { beginAtZero: true, ticks: { stepSize: 5, color: '#9CA3AF' } }
            }
        }
    });
</script>
@endsection