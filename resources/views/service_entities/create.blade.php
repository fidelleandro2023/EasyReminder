@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Crear Entidad de Servicio</h1>

    <form action="{{ route('service-entity.store') }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-6">
        @csrf

        <!-- Nombre de la Entidad -->
        <div>
            <label for="name" class="block font-semibold mb-1">Nombre del Servicio:</label>
            <input type="text" name="name" id="name" 
                class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                value="{{ old('name') }}" placeholder="Ejemplo: Agua, Luz, Teléfono">
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Descripción -->
        <div>
            <label for="description" class="block font-semibold mb-1">Descripción (Opcional):</label>
            <textarea name="description" id="description" 
                class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                placeholder="Breve descripción del servicio">{{ old('description') }}</textarea>
            @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Guardar Servicio
            </button>
            <a href="{{ route('service-entity.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
