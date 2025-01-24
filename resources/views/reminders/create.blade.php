@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Crear Recordatorio</h1>

    <form action="{{ route('reminders.store') }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-6">
        @csrf

        <!-- Pago asociado -->
        <div>
            <label for="payment_id" class="block font-semibold mb-1">Pago Asociado:</label>
            <select name="payment_id" id="payment_id" 
                class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                <option value="">Seleccione un pago</option>
                @foreach ($payments as $payment)
                <option value="{{ $payment->id }}" {{ old('payment_id') == $payment->id ? 'selected' : '' }}>
                    {{ $payment->serviceEntity->name }} - S/. {{ number_format($payment->amount, 2) }}
                </option>
                @endforeach
            </select>
            @error('payment_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tipo de recordatorio -->
        <div>
            <label for="reminder_type" class="block font-semibold mb-1">Tipo de Recordatorio:</label>
            <select name="reminder_type" id="reminder_type" 
                class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                <option value="">Seleccione el tipo</option>
                <option value="email" {{ old('reminder_type') == 'email' ? 'selected' : '' }}>Correo Electrónico</option>
                <option value="push" {{ old('reminder_type') == 'push' ? 'selected' : '' }}>Notificación Push</option>
                <option value="sms" {{ old('reminder_type') == 'sms' ? 'selected' : '' }}>SMS</option>
            </select>
            @error('reminder_type')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Estado -->
        <div>
            <label for="status" class="block font-semibold mb-1">Estado:</label>
            <select name="status" id="status" 
                class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Activo</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('status')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex space-x-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Guardar Recordatorio
            </button>
            <a href="{{ route('reminders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
