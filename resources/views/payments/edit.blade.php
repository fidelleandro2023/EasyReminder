@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Pago</h1>

    <!-- Formulario -->
    <form action="{{ route('payments.update', $payment->id) }}" method="POST" class="space-y-6 bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')

        <!-- Servicio -->
        <div>
            <label for="service_entity_id" class="block font-semibold mb-1">Servicio:</label>
            <select name="service_entity_id" id="service_entity_id" class="w-full border-gray-300 rounded">
                @foreach ($services as $service)
                <option value="{{ $service->id }}" @if ($payment->service_entity_id == $service->id) selected @endif>
                    {{ $service->name }}
                </option>
                @endforeach
            </select>
            @error('service_entity_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Monto -->
        <div>
            <label for="amount" class="block font-semibold mb-1">Monto (S/.):</label>
            <input type="number" name="amount" id="amount" step="0.01" class="w-full border-gray-300 rounded" value="{{ $payment->amount }}">
            @error('amount')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Fecha de vencimiento -->
        <div>
            <label for="due_date" class="block font-semibold mb-1">Fecha de Vencimiento:</label>
            <input type="date" name="due_date" id="due_date" class="w-full border-gray-300 rounded" value="{{ $payment->due_date }}">
            @error('due_date')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Estado -->
        <div>
            <label for="status" class="block font-semibold mb-1">Estado:</label>
            <select name="status" id="status" class="w-full border-gray-300 rounded">
                <option value="pending" @if ($payment->status == 'pending') selected @endif>Pendiente</option>
                <option value="paid" @if ($payment->status == 'paid') selected @endif>Pagado</option>
                <option value="overdue" @if ($payment->status == 'overdue') selected @endif>Vencido</option>
            </select>
            @error('status')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Guardar Cambios
            </button>
            <a href="{{ route('payments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
