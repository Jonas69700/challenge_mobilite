<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-xl">
            <h2 class="text-xl sm:text-2xl font-bold mb-6 text-center sm:text-left">Modifier {{ $user->name }}</h2>

            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                    <input name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
                    @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Équipe</label>
                    <select name="team_id" class="w-full border p-2 rounded focus:ring focus:ring-blue-200">
                        <option value="">— Aucune —</option>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}" @selected($team->id == $user->team_id)>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <input type="hidden" name="is_admin" value="0">
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="is_admin" value="1"
                            {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-200">
                        Administrateur
                    </label>
                </div>

                <button
                    class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                    Enregistrer
                </button>
            </form>
        </div>
    </div>
</x-app-layout>