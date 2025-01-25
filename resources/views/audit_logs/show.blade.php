@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Detalles del Registro de Auditoría</h1>

    <div class="bg-white p-6 shadow rounded-lg">
        <p><strong>Usuario:</strong> {{ $auditLog->user->name ?? 'Usuario Eliminado' }}</p>
        <p><strong>Acción:</strong> {{ $auditLog->action }}</p>
        <p><strong>Entidad:</strong> {{ $auditLog->entity }}</p>
        <p><strong>ID de Entidad:</strong> {{ $auditLog->entity_id }}</p>
        <p><strong>Detalles:</strong> {{ $auditLog->details }}</p>
        <p><strong>Dirección IP:</strong> {{ $auditLog->ip_address }}</p>
        <p><strong>Fecha:</strong> {{ $auditLog->created_at->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('audit-logs.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
            Volver
        </a>
    </div>
</div>
@endsection
