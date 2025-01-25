@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Mis Notificaciones</h1>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Título</th>
                    <th class="px-4 py-2 border">Mensaje</th>
                    <th class="px-4 py-2 border">Estado</th>
                    <th class="px-4 py-2 border">Fecha</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notifications as $notification)
                <tr>
                    <td class="px-4 py-2 border">{{ $notification->title }}</td>
                    <td class="px-4 py-2 border">{{ Str::limit($notification->message, 50) }}</td>
                    <td class="px-4 py-2 border">
                        <span class="{{ $notification->status === 'unread' ? 'text-red-500' : 'text-green-500' }}">
                            {{ ucfirst($notification->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border">{{ $notification->created_at->format('d/m/Y H:i:s') }}</td>
                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('notifications.show', $notification->id) }}" class="text-blue-500 hover:underline">Ver</a>
                        @if ($notification->status === 'unread')
                        <form action="{{ route('notifications.mark-as-read', $notification->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="text-yellow-500 hover:underline">Marcar como Leída</button>
                        </form>
                        @endif
                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar esta notificación?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-4">No tienes notificaciones.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
</div>
@endsection
