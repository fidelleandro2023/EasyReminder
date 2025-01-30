<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Presupuesto') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Crear Nuevo Presupuesto</h1>

        <form action="{{ route('budgets.store') }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-6">
            @csrf

            <!-- Nombre del Presupuesto -->
            <div>
                <label for="name" class="block font-semibold mb-1">Nombre del Presupuesto:</label>
                <input type="text" name="name" id="name" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    value="{{ old('name') }}" placeholder="Ejemplo: Presupuesto Mensual" required>
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="block font-semibold mb-1">Descripción (Opcional):</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    placeholder="Describe brevemente el propósito del presupuesto...">{{ old('description') }}</textarea>
                @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Monto Total -->
            <div>
                <label for="amount" class="block font-semibold mb-1">Monto Total (S/.):</label>
                <input type="number" step="0.01" name="amount" id="amount" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    value="{{ old('amount') }}" placeholder="Ejemplo: 1500.00" required>
                @error('amount')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de Inicio -->
            <div>
                <label for="start_date" class="block font-semibold mb-1">Fecha de Inicio (Opcional):</label>
                <input type="date" name="start_date" id="start_date"
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
                    value="{{ old('start_date') }}">
                @error('start_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de Finalización -->
            <div>
                <label for="end_date" class="block font-semibold mb-1">Fecha de Finalización (Opcional):</label>
                <input type="date" name="end_date" id="end_date"
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
                    value="{{ old('end_date') }}">
                @error('end_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Estado -->
            <div>
                <label for="status" class="block font-semibold mb-1">Estado:</label>
                <select name="status" id="status"
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Activo</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('status')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex space-x-4">
                <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center space-x-1">
                    💾 <span>Guardar Presupuesto</span>
                </button>
                <a href="{{ route('budgets.index') }}" 
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center space-x-1">
                    ❌ <span>Cancelar</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Script para validar fechas -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const startDate = document.getElementById("start_date");
            const endDate = document.getElementById("end_date");

            startDate.addEventListener("change", function() {
                endDate.min = startDate.value;
            });
        });
    </script>
</x-app-layout>
