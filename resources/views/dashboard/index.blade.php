<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-xl space-y-8">

            <h2 class="text-3xl font-bold text-center text-gray-800">Mon tableau de bord</h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                <div class="bg-blue-50 p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Total parcouru</p>
                    <p class="text-2xl font-bold text-blue-800">{{ number_format($totalKm, 2) }} km</p>
                </div>
                <div class="bg-green-50 p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Moyenne par jour</p>
                    <p class="text-2xl font-bold text-green-800">{{ number_format($avgKm, 2) }} km</p>
                </div>
                <div class="bg-yellow-50 p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Vélo / Marche</p>
                    <p class="text-xl font-semibold text-yellow-700">
                        🚴 {{ number_format($byType['bike'], 2) }} km /
                        🚶 {{ number_format($byType['walk'], 2) }} km
                    </p>
                </div>
            </div>

            {{-- Graphique --}}
            <div>
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Évolution sur les 30 derniers jours</h3>
                <canvas id="activityChart" height="120"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('activityChart');

        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($last30days->pluck('date')) !!},
                    datasets: [{
                        label: 'Kilomètres',
                        data: {!! json_encode($last30days->pluck('km')) !!},
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.2)',
                        fill: true,
                        tension: 0.3,
                        pointRadius: 3
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'km'
                            }
                        }
                    }
                }
            });
        }
    </script>
</x-app-layout>