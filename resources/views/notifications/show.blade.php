@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Detalles de la Notificación</h1>

    <div class="bg-white p-6 shadow rounded-lg">
        <p><strong>Título:</strong> {{ $notification->title }}</p>
        <p><strong>Mensaje:</strong> {{ $notification->message }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($notification->status) }}</p>
        <p><strong>Fecha:</strong> {{ $notification->created_at->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('notifications.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
            Volver
        </a>
    </div>
</div>
@endsection
