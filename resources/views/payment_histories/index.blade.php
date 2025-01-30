<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Pagos') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Historial de Pagos</h1>

        <div class="mb-4">
            <a href="{{ route('payment_histories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Registrar Nuevo Pago
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Método de Pago</th>
                        <th class="px-4 py-2 border">Monto Pagado</th>
                        <th class="px-4 py-2 border">Fecha de Pago</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($paymentHistories as $history)
                        <tr>
                            <td class="px-4 py-2 border">{{ $history->id }}</td>
                            <td class="px-4 py-2 border">{{ $history->payment_method }}</td>
                            <td class="px-4 py-2 border">S/. {{ number_format($history->amount_paid, 2) }}</td>
                            <td class="px-4 py-2 border">{{ $history->paid_date }}</td>
                            <td class="px-4 py-2 border text-center">
                                <a href="{{ route('payment_histories.show', $history->id) }}" class="text-blue-500 hover:underline">Ver</a>
                                <form action="{{ route('payment_histories.destroy', $history->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este historial de pago?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">No hay historiales de pagos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <div class="mt-4">
                {{ $paymentHistories->links() }}
            </div>
        </div>
    </div>
</x-app-layout>