<x-app-layout>
    <div class="py-12 container mx-auto">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-xl px-8 py-10 space-y-10">

            {{-- Titre --}}
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-800">Déclaration d'activité</h2>
                <p class="text-gray-500 text-sm mt-1">Ajoutez votre contribution au Challenge Mobilité 🚴‍♂️</p>
            </div>

            {{-- Message succès --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 rounded px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Formulaire --}}
            <form method="POST" action="{{ route('activities.store') }}" class="space-y-6">
                @csrf

                {{-- Date --}}
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" id="date" max="{{ now()->toDateString() }}"
                        value="{{ old('date', now()->toDateString()) }}"
                        class="mt-1 w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                    @error('date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Type --}}
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type d'activité</label>
                    <select name="type" id="type"
                        class="mt-1 w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                        <option value="bike" {{ old('type') === 'bike' ? 'selected' : '' }}>🚴 Vélo</option>
                        <option value="walk" {{ old('type') === 'walk' ? 'selected' : '' }}>🚶 Marche / course</option>
                    </select>
                    @error('type')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Distance ou pas --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="distance_km" class="block text-sm font-medium text-gray-700">Distance (en km)</label>
                        <input type="number" step="0.01" name="distance_km" id="distance_km"
                            value="{{ old('distance_km') }}"
                            class="mt-1 w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                        @error('distance_km')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="steps" class="block text-sm font-medium text-gray-700">Nombre de pas</label>
                        <input type="number" name="steps" id="steps" value="{{ old('steps') }}"
                            class="mt-1 w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
                        @error('steps')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Bouton --}}
                <div class="text-center">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                        ➕ Enregistrer l’activité
                    </button>
                </div>
            </form>

            {{-- Activités récentes --}}
            <div class="pt-8 border-t">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">Mes 10 dernières activités</h3>

                @if ($activities->isEmpty())
                    <p class="text-center text-gray-500 text-sm">Aucune activité pour le moment.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-700 border">
                            <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                                <tr>
                                    <th class="px-4 py-2">Date</th>
                                    <th class="px-4 py-2">Type</th>
                                    <th class="px-4 py-2">Distance (km)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $activity)
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($activity->date)->format('d/m/Y') }}</td>
                                        <td class="px-4 py-2">
                                            {{ $activity->type === 'bike' ? '🚴 Vélo' : '🚶 Marche' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $activity->type === 'walk'
                                                ? number_format($activity->steps / 1500, 2)
                                                : number_format($activity->distance_km, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Affichage conditionnel des champs
        document.addEventListener('DOMContentLoaded', () => {
            const typeSelect = document.getElementById('type');
            const distanceField = document.getElementById('distance_km').parentElement;
            const stepsField = document.getElementById('steps').parentElement;

            function toggleFields() {
                const type = typeSelect.value;
                distanceField.style.display = type === 'bike' ? 'block' : 'none';
                stepsField.style.display = type === 'walk' ? 'block' : 'none';
            }

            typeSelect.addEventListener('change', toggleFields);
            toggleFields(); // init
        });
    </script>
</x-app-layout>
