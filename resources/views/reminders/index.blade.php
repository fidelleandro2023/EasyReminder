<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recordatorios') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Recordatorios</h1> 

        <!-- Botón para crear nuevo recordatorio -->
        <div class="mb-4">
            <a href="{{ route('reminders.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                + Crear Recordatorio
            </a>
        </div> 

        <!-- Tabla de recordatorios -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-3 border">ID</th>
                        <th class="px-4 py-3 border">Servicio</th>
                        <th class="px-4 py-3 border">Tipos</th>
                        <th class="px-4 py-3 border">Fecha</th>
                        <th class="px-4 py-3 border">Estado</th>
                        <th class="px-4 py-3 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reminders as $reminder)
                    <tr class="hover:bg-gray-50">
                        <!-- ID -->
                        <td class="px-4 py-3 border text-center">{{ $reminder->id }}</td>

                        <!-- Servicio asociado -->
                        <td class="px-4 py-3 border text-center">
                            @if ($reminder->payment)
                                {{ $reminder->payment->serviceEntity->name ?? 'N/A' }}
                            @elseif ($reminder->recurringPayment)
                                {{ $reminder->recurringPayment->serviceEntity->name ?? 'N/A' }} (Recurrente)
                            @else
                                <span class="text-gray-500">N/A</span>
                            @endif
                        </td>

                        <!-- Tipos de recordatorio -->
                        <td class="px-4 py-3 border text-center">
                            @if ($reminder->reminder_types)
                                @foreach (json_decode($reminder->reminder_types, true) as $type)
                                    <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">
                                        {{ ucfirst($type) }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-gray-500">No definido</span>
                            @endif
                        </td>

                        <!-- Fecha del recordatorio -->
                        <td class="px-4 py-3 border text-center">
                            {{ $reminder->reminder_date ?? 'N/A' }}
                        </td>

                        <!-- Estado -->
                        <td class="px-4 py-3 border text-center">
                            <span class="px-2 py-1 text-white text-xs font-bold rounded-lg
                                {{ $reminder->status == 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ ucfirst($reminder->status) }}
                            </span>
                        </td>

                        <!-- Acciones -->
                        <td class="px-4 py-3 border text-center">
                            <div class="flex justify-center space-x-4">
                                <!-- Ver -->
                                <a href="{{ route('reminders.show', $reminder->id) }}" 
                                    class="text-blue-500 hover:text-blue-700" title="Ver">
                                    📄
                                </a>

                                <!-- Editar -->
                                <a href="{{ route('reminders.edit', $reminder->id) }}" 
                                    class="text-yellow-500 hover:text-yellow-700" title="Editar">
                                    ✏️
                                </a>

                                <!-- Eliminar -->
                                <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST" 
                                    class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este recordatorio?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" title="Eliminar">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">No tienes recordatorios registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $reminders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
