<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Detalles del Usuario</h1>

        <div class="bg-white p-6 shadow rounded-lg space-y-6">
            <!-- Nombre -->
            <div>
                <p class="font-semibold">Nombre:</p>
                <p class="text-gray-700">{{ $user->name }}</p>
            </div>

            <!-- Correo Electrónico -->
            <div>
                <p class="font-semibold">Correo Electrónico:</p>
                <p class="text-gray-700">{{ $user->email }}</p>
            </div>

            <!-- Fecha de Creación -->
            <div>
                <p class="font-semibold">Cuenta Creada el:</p>
                <p class="text-gray-700">{{ $user->created_at->format('d/m/Y') }}</p>
            </div>

            <!-- Rol (si aplica) -->
            @if(isset($user->role))
                <div>
                    <p class="font-semibold">Rol:</p>
                    <p class="text-gray-700">{{ ucfirst($user->role) }}</p>
                </div>
            @endif

            <!-- Botones -->
            <div class="flex space-x-4">
                <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Editar
                </a>
                
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                        Eliminar
                    </button>
                </form>

                <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Volver a la Lista
                </a>
            </div>
        </div>
    </div>
</x-app-layout>