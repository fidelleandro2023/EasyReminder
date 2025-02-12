<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documentación') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">📚 Guías de Ayuda</h1>
 
        <div class="mb-4">
            <a href="{{ route('help_guides.create') }}" 
                class="bg-blue-600 px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                ➕ Crear Nueva Guía
            </a>
        </div>
 
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="text-left px-6 py-3 text-gray-600 uppercase font-medium">Título</th>
                            <th class="text-left px-6 py-3 text-gray-600 uppercase font-medium">Categoría</th>
                            <th class="text-left px-6 py-3 text-gray-600 uppercase font-medium">Vistas</th>
                            <th class="text-center px-6 py-3 text-gray-600 uppercase font-medium">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if($guides->isEmpty())
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    ❌ No hay guías disponibles. <br>
                                    <a href="{{ route('help_guides.create') }}" class="text-blue-600 hover:underline">
                                        Crea una nueva guía aquí.
                                    </a>
                                </td>
                            </tr>
                        @else
                            @foreach($guides as $guide)
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('help_guides.show', $guide->slug) }}" class="text-blue-600 hover:underline">
                                            {{ $guide->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $guide->category->name ?? 'Sin categoría' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $guide->views }}
                                    </td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('help_guides.edit', $guide->slug) }}" 
                                            class="bg-yellow-500 text-white px-3 py-1 rounded-lg shadow hover:bg-yellow-600 transition">
                                            ✏️ Editar
                                        </a>

                                        <form action="{{ route('help_guides.destroy', $guide->slug) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-lg shadow hover:bg-red-700 transition"
                                                onclick="return confirm('¿Estás seguro de eliminar esta guía?')">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
 
        @if(!$guides->isEmpty())
            <div class="mt-6">
                {{ $guides->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
