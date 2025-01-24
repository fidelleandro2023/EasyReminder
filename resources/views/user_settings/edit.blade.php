@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Configuración</h1>

    <form action="{{ route('user-settings.update', $userSetting->id) }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-6">
        @csrf
        @method('PUT')

        <!-- Clave -->
        <div>
            <label for="key" class="block font-semibold mb-1">Clave de Configuración:</label>
            <input type="text" name="key" id="key" 
                class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                value="{{ old('key', $userSetting->key) }}" placeholder="Ejemplo: notificaciones">
            @error('key')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Valor -->
        <div>
            <label for="value" class="block font-semibold mb-1">Valor de Configuración:</label>
            <input type="text" name="value" id="value" 
                class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                value="{{ old('value', $userSetting->value) }}" placeholder="Ejemplo: activado">
            @error('value')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Guardar Cambios
            </button>
            <a href="{{ route('user-settings.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
