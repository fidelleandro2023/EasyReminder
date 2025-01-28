<x-app-layout>
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Menús</h1>
            <a href="{{ route('menus.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Menú
            </a>
        </div>

        <div class="bg-white shadow rounded-lg">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6">Nombre</th>
                        <th class="py-3 px-6">URL</th>
                        <th class="py-3 px-6">Roles</th>
                        <th class="py-3 px-6">Permisos</th>
                        <th class="py-3 px-6 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach ($menus as $menu)
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-6">{{ $menu->name }}</td>
                            <td class="py-3 px-6">{{ $menu->url }}</td>
                            <td class="py-3 px-6">{{ implode(', ', json_decode($menu->roles ?? '[]')) }}</td>
                            <td class="py-3 px-6">{{ implode(', ', json_decode($menu->permissions ?? '[]')) }}</td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('menus.edit', $menu->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">
                                    Editar
                                </a>
                                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('¿Estás seguro de eliminar este menú?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
