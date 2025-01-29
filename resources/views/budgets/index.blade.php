<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Presupuesto') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Mis Presupuestos</h1>

        <div class="mb-4">
            <a href="{{ route('budgets.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Crear Nuevo Presupuesto
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Monto Total</th>
                        <th class="px-4 py-2 border">Gastado</th>
                        <th class="px-4 py-2 border">Disponible</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($budgets as $budget)
                    <tr>
                        <td class="px-4 py-2 border">{{ $budget->name }}</td>
                        <td class="px-4 py-2 border">S/. {{ number_format($budget->amount, 2) }}</td>
                        <td class="px-4 py-2 border">S/. {{ number_format($budget->spent, 2) }}</td>
                        <td class="px-4 py-2 border">S/. {{ number_format($budget->available_budget, 2) }}</td>
                        <td class="px-4 py-2 border text-center">
                            <a href="{{ route('budgets.show', $budget->id) }}" class="text-blue-500 hover:underline">Ver</a>
                            <a href="{{ route('budgets.edit', $budget->id) }}" class="text-yellow-500 hover:underline">Editar</a>
                            <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este presupuesto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">No tienes presupuestos registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout> 
