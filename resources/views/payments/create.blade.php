<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pagos') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Crear Nuevo Pago</h1>

        <!-- Formulario -->
        <form action="{{ route('payments.store') }}" method="POST" class="space-y-6 bg-white shadow rounded-lg p-6">
            @csrf

            <!-- Servicio -->
            <div>
                <label for="service_entity_id" class="block font-semibold mb-1">Servicio:</label>
                <select name="service_entity_id" id="service_entity_id" class="w-full border-gray-300 rounded">
                    @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                @error('service_entity_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Monto -->
            <div>
                <label for="amount" class="block font-semibold mb-1">Monto (S/.):</label>
                <input type="number" name="amount" id="amount" step="0.01" class="w-full border-gray-300 rounded" value="{{ old('amount') }}">
                @error('amount')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de vencimiento -->
            <div>
                <label for="due_date" class="block font-semibold mb-1">Fecha de Vencimiento:</label>
                <input type="date" name="due_date" id="due_date" class="w-full border-gray-300 rounded" value="{{ old('due_date') }}">
                @error('due_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Guardar
                </button>
                <a href="{{ route('payments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>