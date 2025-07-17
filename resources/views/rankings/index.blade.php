<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-8 text-center">Classements</h1>

        {{-- MA POSITION --}}
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8 text-center max-w-md mx-auto">
            <p class="text-gray-700">Tu es classé</p>
            <p class="text-4xl font-bold text-blue-700">{{ $rank }}<sup>e</sup></p>
            <p class="text-gray-600">sur {{ $totalUsers }} participants</p>
        </div>

        {{-- CLASSEMENT UTILISATEURS (TOP 10) --}}
        <div class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">🏅 Top 10 des utilisateurs</h2>
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Total km</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topUsers as $index => $user)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ number_format($user->total_km, 3, ',', ' ') }} km</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- CLASSEMENT GÉNÉRAL --}}
        <div class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">📋 Classement général</h2>
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Total km</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topUsers->concat($users->diff($topUsers)) as $index => $user)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ number_format($user->total_km, 3, ',', ' ') }} km</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- CLASSEMENT ÉQUIPES --}}
        <div class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">👥 Classement des équipes</h2>
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">Équipe</th>
                            <th class="px-4 py-2">Membres</th>
                            <th class="px-4 py-2">Total km</th>
                            <th class="px-4 py-2">Moyenne / membre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teams as $team)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $team->name }}</td>
                            <td class="px-4 py-2">{{ $team->members_count }}</td>
                            <td class="px-4 py-2">{{ number_format($team->total_km, 3, ',', ' ') }} km</td>
                            <td class="px-4 py-2">{{ number_format($team->average_km, 3, ',', ' ') }} km</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- STATISTIQUES GLOBALES --}}
        <div class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">📊 Statistiques du challenge</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded shadow text-center">
                    <p class="text-sm text-gray-500">Participants</p>
                    <p class="text-xl font-bold">{{ $globalStats['total_users'] }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <p class="text-sm text-gray-500">Équipes</p>
                    <p class="text-xl font-bold">{{ $globalStats['total_teams'] }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <p class="text-sm text-gray-500">Total km</p>
                    <p class="text-xl font-bold">{{ number_format($globalStats['total_km'], 3, ',', ' ') }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <p class="text-sm text-gray-500">Moyenne / utilisateur</p>
                    <p class="text-xl font-bold">{{ number_format($globalStats['average_per_user'], 3, ',', ' ') }} km</p>
                </div>
            </div>
        </div>

        {{-- EXPORT CSV (admin seulement) --}}
        @if (auth()->user()->is_admin)
        <div class="text-center mt-10">
            <a href="{{ route('admin.export.csv') }}" class="bg-green-600 text-white px-4 py-2 rounded">
                📁 Exporter les données (CSV)
            </a>
        </div>
        @endif
    </div>
</x-app-layout>