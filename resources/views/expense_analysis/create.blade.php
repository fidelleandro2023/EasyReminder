<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Análisis de Gastos') }}
        </h2>
    </x-slot>
    
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Nuevo Análisis de Gastos</h1>

        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('expense.analysis.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="category" class="block text-gray-700 font-bold mb-2">Categoría:</label>
                    <input type="text" id="category" name="category" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div class="mb-4">
                    <label for="total_spent" class="block text-gray-700 font-bold mb-2">Total Gastado (S/.):</label>
                    <input type="number" id="total_spent" name="total_spent" step="0.01" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div class="mb-4">
                    <label for="period" class="block text-gray-700 font-bold mb-2">Período:</label>
                    <input type="text" id="period" name="period" placeholder="Ejemplo: Enero 2024" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div class="flex justify-between">
                    <a href="{{ route('expense.analysis') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancelar</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
