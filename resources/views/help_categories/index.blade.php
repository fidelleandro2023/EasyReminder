<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorías de Ayud') }}
        </h2>
    </x-slot>
    <div class="container max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg"> 
        <!-- Botón para crear nueva categoría -->
        <a href="{{ route('help_categories.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            + Nueva Categoría
        </a>

        <!-- Tabla de Categorías -->
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Estado</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr class="border-b">
                        <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $category->name }}</td>
                        <td class="px-4 py-2 border text-center">
                            <span class="px-2 py-1 text-xs font-semibold rounded 
                                {{ $category->status ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ $category->status ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border text-center">
                            <a href="{{ route('help_categories.edit', $category) }}" class="text-blue-500 hover:underline">Editar</a> |
                            <form action="{{ route('help_categories.destroy', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
