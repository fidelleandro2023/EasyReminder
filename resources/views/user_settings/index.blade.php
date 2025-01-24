@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Mis Configuraciones</h1>

    <div class="mb-4">
        <a href="{{ route('user-settings.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Crear Configuración
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Clave</th>
                    <th class="px-4 py-2 border">Valor</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($userSettings as $setting)
                <tr>
                    <td class="px-4 py-2 border">{{ $setting->key }}</td>
                    <td class="px-4 py-2 border">{{ $setting->value }}</td>
                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('user-settings.edit', $setting->id) }}" class="text-yellow-500 hover:underline">Editar</a>
                        <form action="{{ route('user-settings.destroy', $setting->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar esta configuración?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-gray-500 py-4">No tienes configuraciones registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
