<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Presupuesto') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Detalles del Presupuesto</h1>

            <!-- Nombre del Presupuesto -->
            <div class="mb-4">
                <strong class="text-gray-700">Nombre:</strong> {{ $budget->name }}
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <strong class="text-gray-700">Descripción:</strong> 
                {{ $budget->description ?? 'Sin descripción' }}
            </div>

            <!-- Estado del Presupuesto -->
            <div class="mb-4">
                <strong class="text-gray-700">Estado:</strong> 
                <span class="px-2 py-1 text-white text-xs font-bold rounded-lg
                    {{ $budget->status == 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                    {{ ucfirst($budget->status) }}
                </span>
            </div>

            <!-- Fechas -->
            <div class="mb-4">
                <strong class="text-gray-700">Fecha de Inicio:</strong> 
                {{ $budget->start_date ?? 'No definida' }}
            </div>
            <div class="mb-4">
                <strong class="text-gray-700">Fecha de Finalización:</strong> 
                {{ $budget->end_date ?? 'No definida' }}
            </div>

            <!-- Monto Total -->
            <div class="mb-4">
                <strong class="text-gray-700">Monto Total:</strong> 
                S/. {{ number_format($budget->amount, 2) }}
            </div>

            <!-- Gastado -->
            <div class="mb-4">
                <strong class="text-gray-700">Gastado:</strong> 
                S/. {{ number_format($budget->spent, 2) }}
            </div>

            <!-- Disponible -->
            <div class="mb-4">
                <strong class="text-gray-700">Saldo Disponible:</strong> 
                <span class="{{ $budget->available_budget < 0 ? 'text-red-500' : 'text-green-500' }}">
                    S/. {{ number_format($budget->available_budget, 2) }}
                </span>
            </div>

            <!-- Barra de Progreso -->
            <div class="mb-4">
                <strong class="text-gray-700">Progreso del Gasto:</strong>
                <div class="relative w-full bg-gray-200 rounded h-4 mt-1">
                    <div class="absolute top-0 left-0 h-4 rounded 
                        {{ ($budget->spent / $budget->amount) * 100 >= 100 ? 'bg-red-500' : 'bg-blue-500' }}"
                        style="width: {{ min(100, ($budget->spent / max($budget->amount, 1)) * 100) }}%;">
                    </div>
                </div>
                <p class="text-sm mt-1 text-gray-700">
                    {{ number_format(($budget->spent / max($budget->amount, 1)) * 100, 2) }}% gastado
                </p>
            </div>

            <!-- Creado y Actualizado -->
            <div class="mb-4">
                <strong class="text-gray-700">Creado el:</strong> {{ $budget->created_at->format('d/m/Y H:i') }}
            </div>
            <div class="mb-4">
                <strong class="text-gray-700">Última actualización:</strong> {{ $budget->updated_at->format('d/m/Y H:i') }}
            </div>

            <!-- Botones de Acción -->
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('budgets.edit', $budget->id) }}" 
                   class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 flex items-center space-x-1">
                    ✏️ <span>Editar</span>
                </a>

                <a href="{{ route('budgets.index') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center space-x-1">
                    🔙 <span>Volver</span>
                </a>

                <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" 
                      onsubmit="return confirm('¿Estás seguro de eliminar este presupuesto?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center space-x-1">
                        🗑️ <span>Eliminar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
