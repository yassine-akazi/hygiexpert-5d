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

        


        <!-- Line Chart -->
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
  const ctx = document.getElementById('clientGrowthChart').getContext('2d');

// Exemple de données, à remplacer par des données dynamiques venant du serveur
const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
const data = {
    labels: labels,
    datasets: [{
        label: 'Nombre de clients',
        data: [12, 19, 3, 5, 2, 7], // données à remplacer
        fill: false,
        borderColor: 'rgb(99, 102, 241)', // indigo-600 en Tailwind
        tension: 0.1
    }]
};

const config = {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
};

const clientGrowthChart = new Chart(ctx, config);

</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection