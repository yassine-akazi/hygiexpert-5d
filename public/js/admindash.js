document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('clientGrowthChart').getContext('2d');
    const { months, clientCounts } = window.chartData;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Inscriptions',
                data: clientCounts,
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
                    labels: { color: '#ccc' }
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
});