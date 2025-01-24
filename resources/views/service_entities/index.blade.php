@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Entidades de Servicio</h1>

    <div class="mb-4">
        <a href="{{ route('service-entity.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Crear Nueva Entidad de Servicio
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Descripción</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($serviceEntities as $entity)
                <tr>
                    <td class="px-4 py-2 border">{{ $entity->name }}</td>
                    <td class="px-4 py-2 border">{{ $entity->description ?? 'N/A' }}</td>
                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('service-entity.show', $entity->id) }}" class="text-blue-500 hover:underline">Ver</a>
                        <a href="{{ route('service-entity.edit', $entity->id) }}" class="text-yellow-500 hover:underline">Editar</a>
                        <form action="{{ route('service-entity.destroy', $entity->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar esta entidad de servicio?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-gray-500 py-4">No hay entidades de servicio registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
