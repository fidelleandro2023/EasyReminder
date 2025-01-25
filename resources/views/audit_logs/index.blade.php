@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Registros de Auditoría</h1>

    <div class="mb-4">
        <form method="GET" class="flex space-x-4">
            <input type="text" name="user_id" placeholder="Filtrar por Usuario (ID)"
                class="w-1/4 border-gray-300 rounded-lg focus:ring focus:ring-blue-200" value="{{ request('user_id') }}">
            <input type="text" name="entity" placeholder="Filtrar por Entidad"
                class="w-1/4 border-gray-300 rounded-lg focus:ring focus:ring-blue-200" value="{{ request('entity') }}">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Filtrar
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Usuario</th>
                    <th class="px-4 py-2 border">Acción</th>
                    <th class="px-4 py-2 border">Entidad</th>
                    <th class="px-4 py-2 border">ID Entidad</th>
                    <th class="px-4 py-2 border">Fecha</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($auditLogs as $log)
                <tr>
                    <td class="px-4 py-2 border">{{ $log->user->name ?? 'Usuario Eliminado' }}</td>
                    <td class="px-4 py-2 border">{{ $log->action }}</td>
                    <td class="px-4 py-2 border">{{ $log->entity }}</td>
                    <td class="px-4 py-2 border">{{ $log->entity_id }}</td>
                    <td class="px-4 py-2 border">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('audit-logs.show', $log->id) }}" class="text-blue-500 hover:underline">Ver</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-4">No hay registros de auditoría.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $auditLogs->links() }}
    </div>
</div>
@endsection
