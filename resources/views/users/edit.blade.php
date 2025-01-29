<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Editar Usuario</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div>
                <label for="name" class="block font-semibold mb-1">Nombre:</label>
                <input type="text" name="name" id="name" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    value="{{ old('name', $user->name) }}" required>
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Correo -->
            <div>
                <label for="email" class="block font-semibold mb-1">Correo Electrónico:</label>
                <input type="email" name="email" id="email" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    value="{{ old('email', $user->email) }}" required>
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block font-semibold mb-1">Contraseña (Opcional):</label>
                <input type="password" name="password" id="password" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    placeholder="Dejar en blanco para no cambiar">
                @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirmación de Contraseña -->
            <div>
                <label for="password_confirmation" class="block font-semibold mb-1">Confirmar Contraseña:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <!-- Botones -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Guardar Cambios
                </button>
                <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout> 