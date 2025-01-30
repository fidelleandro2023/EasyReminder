<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Análisis de gastos') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Análisis de Gastos</h1>

        <div class="mb-4">
            <a href="{{ route('expense.analysis.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Crear Nuevo Análisis
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Categoría</th>
                        <th class="px-4 py-2 border">Total Gastado</th>
                        <th class="px-4 py-2 border">Período</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expenseAnalyses as $analysis)
                    <tr>
                        <td class="px-4 py-2 border">{{ $analysis->category }}</td>
                        <td class="px-4 py-2 border">S/. {{ number_format($analysis->total_spent, 2) }}</td>
                        <td class="px-4 py-2 border">{{ $analysis->period }}</td>
                        <td class="px-4 py-2 border text-center">
                            <a href="{{ route('expense-analysis.show', $analysis->id) }}" class="text-blue-500 hover:underline">Ver</a>
                            <form action="{{ route('expense-analysis.destroy', $analysis->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este análisis?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">No hay análisis de gastos registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            {{ $expenseAnalyses->links() }}
        </div>
    </div>
</x-app-layout>