<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Historial de Pago') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Registrar Historial de Pago</h1>
            
            <form action="{{ route('payment_histories.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="payment_id" class="block text-gray-700 font-bold mb-2">Pago Pendiente</label>
                    <select name="payment_id" id="payment_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                        @foreach ($payments as $payment)
                            <option value="{{ $payment->id }}">{{ $payment->description }} - S/. {{ number_format($payment->amount, 2) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="paid_date" class="block text-gray-700 font-bold mb-2">Fecha de Pago</label>
                    <input type="date" name="paid_date" id="paid_date" class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="amount_paid" class="block text-gray-700 font-bold mb-2">Monto Pagado</label>
                    <input type="number" name="amount_paid" id="amount_paid" step="0.01" class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="payment_method" class="block text-gray-700 font-bold mb-2">Método de Pago</label>
                    <input type="text" name="payment_method" id="payment_method" class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
