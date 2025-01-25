<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Crear Nuevo Permiso</h1>

        <form action="{{ route('permissions.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nombre del Permiso:</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
