<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Historial de Pago') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Detalle del Historial de Pago</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="mb-4"><strong>ID de Pago:</strong> {{ $paymentHistory->payment_id }}</p>
            <p class="mb-4"><strong>Fecha de Pago:</strong> {{ $paymentHistory->paid_date }}</p>
            <p class="mb-4"><strong>Monto Pagado:</strong> S/. {{ number_format($paymentHistory->amount_paid, 2) }}</p>
            <p class="mb-4"><strong>Método de Pago:</strong> {{ $paymentHistory->payment_method }}</p>

            <div class="mt-6">
                <a href="{{ route('payment_histories.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Volver
                </a>
                <a href="{{ route('payment_histories.edit', $paymentHistory->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Editar
                </a>
                <form action="{{ route('payment_histories.destroy', $paymentHistory->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este historial de pago?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
