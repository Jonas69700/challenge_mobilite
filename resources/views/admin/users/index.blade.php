<x-app-layout>
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-xl">
            <h2 class="text-xl sm:text-2xl font-bold mb-6 text-center sm:text-left">Utilisateurs</h2>

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 p-3 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Mobile version (cards) --}}
            <div class="space-y-4 sm:hidden">
                @foreach ($users as $user)
                    <div class="border rounded p-4 shadow-sm bg-gray-50">
                        <p class="font-semibold">{{ $user->name }}</p>
                        <p class="text-sm text-gray-600 break-all">{{ $user->email }}</p>
                        <p class="text-sm text-gray-700">Équipe : {{ $user->team->name ?? '—' }}</p>
                        <p class="text-sm">Admin : {{ $user->is_admin ? '✅' : '❌' }}</p>
                        <div class="mt-2 flex gap-4 text-sm">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Desktop version (table) --}}
            <div class="overflow-x-auto hidden sm:block">
                <table class="min-w-full text-sm text-left border rounded">
                    <thead class="bg-gray-100 text-gray-700 uppercase">
                        <tr>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Équipe</th>
                            <th class="p-3">Admin</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-3">{{ $user->name }}</td>
                                <td class="p-3 break-all">{{ $user->email }}</td>
                                <td class="p-3">{{ $user->team->name ?? '—' }}</td>
                                <td class="p-3 text-center">{{ $user->is_admin ? '✅' : '❌' }}</td>
                                <td class="p-3 space-x-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:underline">Modifier</a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline"
                                            onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
