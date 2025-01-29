<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Recordatorio') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Detalles del Recordatorio</h1>

            <div class="mb-4">
                <strong>ID:</strong> {{ $reminder->id }}
            </div>
            <div class="mb-4">
                <strong>Servicio:</strong> {{ $reminder->payment->serviceEntity->name ?? 'N/A' }}
            </div>
            <div class="mb-4">
                <strong>Tipo de Recordatorio:</strong> {{ ucfirst($reminder->reminder_type) }}
            </div>
            <div class="mb-4">
                <strong>Estado:</strong> 
                <span class="{{ $reminder->status == 'active' ? 'text-green-500' : 'text-red-500' }}">
                    {{ ucfirst($reminder->status) }}
                </span>
            </div>
            <div class="mb-4">
                <strong>Creado el:</strong> {{ $reminder->created_at->format('d/m/Y H:i') }}
            </div>
            <div class="mb-4">
                <strong>Última actualización:</strong> {{ $reminder->updated_at->format('d/m/Y H:i') }}
            </div>

            <div class="mt-6 flex space-x-4">
                <a href="{{ route('reminders.edit', $reminder->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                    Editar
                </a>
                <a href="{{ route('reminders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Volver a la lista
                </a>
                <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este recordatorio?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>