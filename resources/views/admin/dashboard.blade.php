<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-xl">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Espace Admin 🛠️</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('admin.users.index') }}" class="block bg-blue-100 hover:bg-blue-200 p-5 rounded-xl shadow text-blue-800 text-center font-semibold">
                    👤 Gérer les utilisateurs
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
