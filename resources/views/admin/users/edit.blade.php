<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-xl">
            <h2 class="text-2xl font-bold mb-6">Modifier {{ $user->name }}</h2>

            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block">Nom</label>
                    <input name="name" value="{{ old('name', $user->name) }}" class="w-full border p-2 rounded">
                    @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block">Équipe</label>
                    <select name="team_id" class="w-full border p-2 rounded">
                        <option value="">— Aucune —</option>
                        @foreach ($teams as $team)
                        <option value="{{ $team->id }}" @selected($team->id == $user->team_id)>{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    {{-- Champ caché envoyé si case décochée --}}
                    <input type="hidden" name="is_admin" value="0">
                    <label>
                        <input type="checkbox" name="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                        Administrateur
                    </label>
                </div>


                <button class="bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
            </form>
        </div>
    </div>
</x-app-layout>