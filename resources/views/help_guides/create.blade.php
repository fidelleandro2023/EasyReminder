<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documentación') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">📄 Crear Nueva Guía</h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('help_guides.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Título -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" name="title" class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-300" required>
                </div>

                <!-- Categoría -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                    <select name="category_id" class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-300">
                        <option value="">Sin categoría</option>
                        <!-- Opciones de categorías aquí -->
                    </select>
                </div>

                <!-- Contenido -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Contenido</label>
                    <textarea name="content" rows="5" class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-300" required></textarea>
                </div>

                <!-- URL del Video -->
                <div>
                    <label for="video_url" class="block text-sm font-medium text-gray-700">URL del Video (opcional)</label>
                    <input type="url" name="video_url" class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <!-- Orden -->
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700">Orden</label>
                    <input type="number" name="order" class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <!-- Publicar -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" class="h-5 w-5 text-blue-600 border-gray-300 rounded" checked>
                    <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">¿Publicar?</label>
                </div>

                <!-- Botones -->
                <div class="flex justify-between mt-4">
                    <button type="submit" class="bg-gray-500  px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
                        ✅ Guardar
                    </button>
                    <a href="{{ route('help_guides.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-600 transition">
                        ❌ Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
