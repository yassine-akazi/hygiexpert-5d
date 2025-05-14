@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('navbar')
    @include('admin.partials.navbar')  <!-- Top Bar -->
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')  <!-- Sidebar -->
@endsection

@section('content')
    <div class="p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-semibold">Welcome to the Admin Dashboard</h1>
        <p class="text-gray-600 mt-2">Overview of your client data.</p>
    </div>

    <!-- Analytics Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <!-- Total Clients -->
        <div class="p-4 bg-indigo-600 text-white rounded shadow">
            <h2 class="text-xl font-semibold">Total Clients</h2>
            <p class="text-3xl">{{ $totalClients }}</p>
        </div>

        <!-- Recent Clients -->
        <div class="p-4 bg-gray-200 rounded shadow">
            <h2 class="text-xl font-semibold">Recent Clients</h2>
            <ul class="list-disc pl-4 mt-2">
                @foreach ($recentClients as $client)
                    <li>{{ $client->nom }} ({{ $client->email }})</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Optional: Graph for client growth (e.g., line chart) -->
    <div class="mt-8">
        <canvas id="clientGrowthChart"></canvas>
    </div>

    <script>
        // Example for a line chart (replace with actual data)
        var ctx = document.getElementById('clientGrowthChart').getContext('2d');
        var clientGrowthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'],  // Example labels
                datasets: [{
                    label: 'Client Growth',
                    data: [0, 5, 10, 15, 20], // Example data, replace with actual client data
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection