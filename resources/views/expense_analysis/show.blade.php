<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Análisis de Gastos') }}
        </h2>
    </x-slot>
    
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Detalle del Análisis</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="text-lg font-semibold">Categoría: <span class="text-gray-700">{{ $analysis->category }}</span></p>
            <p class="text-lg font-semibold">Total Gastado: <span class="text-gray-700">S/. {{ number_format($analysis->total_spent, 2) }}</span></p>
            <p class="text-lg font-semibold">Período: <span class="text-gray-700">{{ $analysis->period }}</span></p>
        </div>

        <div class="mt-6">
            <a href="{{ route('expense-analysis.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Volver</a>
            <a href="{{ route('expense-analysis.edit', $analysis->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Editar</a>
            <form action="{{ route('expense-analysis.destroy', $analysis->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este análisis?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Eliminar</button>
            </form>
        </div>
    </div>
</x-app-layout>