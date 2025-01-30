<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Análisis de Gastos') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Editar Análisis de Gastos</h1>

        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('expense-analysis.update', $analysis->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="category" class="block text-gray-700 font-semibold">Categoría</label>
                    <input type="text" id="category" name="category" value="{{ old('category', $analysis->category) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="total_spent" class="block text-gray-700 font-semibold">Total Gastado</label>
                    <input type="number" step="0.01" id="total_spent" name="total_spent" value="{{ old('total_spent', $analysis->total_spent) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="period" class="block text-gray-700 font-semibold">Período</label>
                    <input type="text" id="period" name="period" value="{{ old('period', $analysis->period) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('expense.analysis.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 mr-2">Cancelar</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
