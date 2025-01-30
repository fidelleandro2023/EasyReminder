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
                <strong class="text-gray-700">ID:</strong> {{ $reminder->id }}
            </div>

            <!-- Servicio Asociado -->
            <div class="mb-4">
                <strong class="text-gray-700">Servicio:</strong> 
                @if ($reminder->payment)
                    {{ $reminder->payment->serviceEntity->name ?? 'N/A' }}
                @elseif ($reminder->recurringPayment)
                    {{ $reminder->recurringPayment->serviceEntity->name ?? 'N/A' }} (Recurrente)
                @else
                    <span class="text-gray-500">N/A</span>
                @endif
            </div>

            <!-- Tipos de Recordatorio -->
            <div class="mb-4">
                <strong class="text-gray-700">Tipos de Recordatorio:</strong>
                @if ($reminder->reminder_types)
                    @foreach (json_decode($reminder->reminder_types, true) as $type)
                        <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">
                            {{ ucfirst($type) }}
                        </span>
                    @endforeach
                @else
                    <span class="text-gray-500">No definido</span>
                @endif
            </div>

            <!-- Fecha de Recordatorio -->
            <div class="mb-4">
                <strong class="text-gray-700">Fecha del Recordatorio:</strong> 
                {{ $reminder->reminder_date ?? 'N/A' }}
            </div>

            <!-- Estado -->
            <div class="mb-4">
                <strong class="text-gray-700">Estado:</strong> 
                <span class="px-2 py-1 text-white text-xs font-bold rounded-lg
                    {{ $reminder->status == 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                    {{ ucfirst($reminder->status) }}
                </span>
            </div>

            <!-- Fechas de Creación y Actualización -->
            <div class="mb-4">
                <strong class="text-gray-700">Creado el:</strong> {{ $reminder->created_at->format('d/m/Y H:i') }}
            </div>
            <div class="mb-4">
                <strong class="text-gray-700">Última actualización:</strong> {{ $reminder->updated_at->format('d/m/Y H:i') }}
            </div>

            <!-- Botones de Acción -->
            <div class="mt-6 flex space-x-4">
                <!-- Editar -->
                <a href="{{ route('reminders.edit', $reminder->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 flex items-center space-x-1">
                    ✏️ <span>Editar</span>
                </a>

                <!-- Volver -->
                <a href="{{ route('reminders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center space-x-1">
                    🔙 <span>Volver</span>
                </a>

                <!-- Eliminar -->
                <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST" 
                    onsubmit="return confirm('¿Estás seguro de eliminar este recordatorio?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center space-x-1">
                        🗑️ <span>Eliminar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>