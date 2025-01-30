<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Historial de Pago') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Editar Historial de Pago</h1>

        <form action="{{ route('payment_histories.update', $paymentHistory->id) }}" method="POST" class="max-w-lg bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="payment_id" class="block font-medium text-gray-700">Pago Asociado</label>
                <select name="payment_id" id="payment_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                    @foreach ($payments as $payment)
                        <option value="{{ $payment->id }}" {{ $payment->id == $paymentHistory->payment_id ? 'selected' : '' }}>
                            {{ $payment->description }} - S/. {{ number_format($payment->amount, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="paid_date" class="block font-medium text-gray-700">Fecha de Pago</label>
                <input type="date" name="paid_date" id="paid_date" value="{{ $paymentHistory->paid_date->format('Y-m-d') }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div class="mb-4">
                <label for="amount_paid" class="block font-medium text-gray-700">Monto Pagado</label>
                <input type="number" step="0.01" name="amount_paid" id="amount_paid" value="{{ $paymentHistory->amount_paid }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div class="mb-4">
                <label for="payment_method" class="block font-medium text-gray-700">Método de Pago</label>
                <input type="text" name="payment_method" id="payment_method" value="{{ $paymentHistory->payment_method }}" class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Guardar Cambios
                </button>
                <a href="{{ route('payment_histories.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
