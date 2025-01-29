<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Presupuesto') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Editar Presupuesto</h1>

        <form action="{{ route('budgets.update', $budget->id) }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre del Presupuesto -->
            <div>
                <label for="name" class="block font-semibold mb-1">Nombre del Presupuesto:</label>
                <input type="text" name="name" id="name" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    value="{{ old('name', $budget->name) }}" placeholder="Ejemplo: Presupuesto Mensual">
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="block font-semibold mb-1">Descripción (Opcional):</label>
                <textarea name="description" id="description" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    placeholder="Describe brevemente el propósito del presupuesto...">{{ old('description', $budget->description) }}</textarea>
                @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Monto Total -->
            <div>
                <label for="amount" class="block font-semibold mb-1">Monto Total (S/.):</label>
                <input type="number" step="0.01" name="amount" id="amount" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    value="{{ old('amount', $budget->amount) }}" placeholder="Ejemplo: 1500.00">
                @error('amount')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Guardar Cambios
                </button>
                <a href="{{ route('budgets.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout> 