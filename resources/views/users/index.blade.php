<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Lista de Usuarios</h1>
        <div class="mb-4">
            <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Crear usuario
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Correo</th>
                        <th class="px-4 py-2 border">Fecha de Registro</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 border text-center">
                            <a href="{{ route('users.show', $user->id) }}" class="text-blue-500 hover:underline">Ver</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-500 hover:underline">Editar</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">No hay usuarios registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout> 