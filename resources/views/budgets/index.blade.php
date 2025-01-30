<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Presupuesto') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Mis Presupuestos</h1>

        <!-- Botón Crear Nuevo Presupuesto -->
        <div class="mb-4">
            <a href="{{ route('budgets.create') }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center space-x-2">
                ➕ <span>Crear Nuevo Presupuesto</span>
            </a>
        </div>

        <!-- Tabla de Presupuestos -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Monto Total</th>
                        <th class="px-4 py-2 border">Gastado</th>
                        <th class="px-4 py-2 border">Disponible</th>
                        <th class="px-4 py-2 border">Estado</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($budgets as $budget)
                    <tr>
                        <!-- Nombre -->
                        <td class="px-4 py-2 border">{{ $budget->name }}</td>
                        
                        <!-- Monto Total -->
                        <td class="px-4 py-2 border">S/. {{ number_format($budget->amount, 2) }}</td>

                        <!-- Gastado -->
                        <td class="px-4 py-2 border">S/. {{ number_format($budget->spent, 2) }}</td>

                        <!-- Disponible (rojo si negativo) -->
                        <td class="px-4 py-2 border">
                            <span class="{{ $budget->available_budget < 0 ? 'text-red-500' : 'text-green-500' }}">
                                S/. {{ number_format($budget->available_budget, 2) }}
                            </span>
                        </td>

                        <!-- Estado (Activo/Inactivo con colores) -->
                        <td class="px-4 py-2 border">
                            <span class="px-2 py-1 text-white text-xs font-bold rounded-lg
                                {{ $budget->status == 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ ucfirst($budget->status) }}
                            </span>
                        </td>

                        <!-- Acciones -->
                        <td class="px-4 py-2 border text-center flex space-x-2">
                            <a href="{{ route('budgets.show', $budget->id) }}" 
                               class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 flex items-center space-x-1">
                                🔍 <span>Ver</span>
                            </a>

                            <a href="{{ route('budgets.edit', $budget->id) }}" 
                               class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 flex items-center space-x-1">
                                ✏️ <span>Editar</span>
                            </a>

                            <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" 
                                  class="inline-block"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este presupuesto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 flex items-center space-x-1">
                                    🗑️ <span>Eliminar</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">No tienes presupuestos registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $budgets->links() }}
            </div>
        </div>
    </div>
</x-app-layout>