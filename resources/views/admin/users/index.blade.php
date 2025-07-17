<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-xl">
            <h2 class="text-2xl font-bold mb-6">Utilisateurs</h2>

            @if (session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">{{ session('success') }}</div>
            @endif

            <table class="w-full table-auto text-sm text-left">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="p-2">Nom</th>
                        <th class="p-2">Email</th>
                        <th class="p-2">Équipe</th>
                        <th class="p-2">Admin</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-2">{{ $user->name }}</td>
                        <td class="p-2">{{ $user->email }}</td>
                        <td class="p-2">{{ $user->team->name ?? '—' }}</td>
                        <td class="p-2">{{ $user->is_admin ? '✅' : '❌' }}</td>
                        <td class="p-2 space-x-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600">Modifier</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600"
                                    onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>