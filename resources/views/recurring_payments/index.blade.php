<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pagos recurrentes') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Pagos Recurrentes</h1>

        <div class="mb-4">
            <a href="{{ route('recurring_payments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Crear Pago Recurrente
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Servicio</th>
                        <th class="px-4 py-2 border">Monto</th>
                        <th class="px-4 py-2 border">Frecuencia</th>
                        <th class="px-4 py-2 border">Inicio</th>
                        <th class="px-4 py-2 border">Fin</th>
                        <th class="px-4 py-2 border">Estado</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recurringPayments as $payment)
                    <tr>
                        <td class="px-4 py-2 border">{{ $payment->serviceEntity->name }}</td>
                        <td class="px-4 py-2 border">S/. {{ number_format($payment->amount, 2) }}</td>
                        <td class="px-4 py-2 border capitalize">{{ $payment->frequency }}</td>
                        <td class="px-4 py-2 border">{{ $payment->start_date }}</td>
                        <td class="px-4 py-2 border">{{ $payment->end_date ?? 'Indefinido' }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($payment->status) }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('recurring_payments.show', $payment->id) }}" class="text-blue-500 hover:underline">Ver</a>
                            <a href="{{ route('recurring_payments.edit', $payment->id) }}" class="text-yellow-500 hover:underline">Editar</a>
                            <form action="{{ route('recurring_payments.destroy', $payment->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este pago recurrente?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">No tienes pagos recurrentes registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <div class="mt-4">
                {{ $recurringPayments->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 