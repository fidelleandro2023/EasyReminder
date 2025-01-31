<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Pagos Vencidos') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Pagos Vencidos</h2>

            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($payments->isEmpty())
                <div class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-md">
                    No hay pagos vencidos en este momento.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200 shadow-sm rounded-lg">
                        <thead class="bg-gray-100">
                            <tr class="text-left">
                                <th class="px-4 py-2 border">#</th>
                                <th class="px-4 py-2 border">Usuario</th>
                                <th class="px-4 py-2 border">Servicio</th>
                                <th class="px-4 py-2 border">Monto</th>
                                <th class="px-4 py-2 border">Fecha de vencimiento</th>
                                <th class="px-4 py-2 border">Estado</th>
                                <th class="px-4 py-2 border">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr class="border hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 border">{{ $payment->user->name }}</td>
                                    <td class="px-4 py-2 border">{{ $payment->serviceEntity->name }}</td>
                                    <td class="px-4 py-2 border text-right font-semibold">${{ number_format($payment->amount, 2) }}</td>
                                    <td class="px-4 py-2 border text-red-600 font-semibold">
                                        {{ \Carbon\Carbon::parse($payment->due_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        <span class="inline-block bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-md">
                                            Vencido
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border flex space-x-2">
                                        <a href="{{ route('payments.edit', $payment) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold px-3 py-1 rounded-md">
                                            Editar
                                        </a>
                                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este pago?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-3 py-1 rounded-md">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-4">
                    {{ $payments->links() }}
                </div>
            @endif

            <a href="{{ route('payments.index') }}" class="mt-4 inline-block bg-gray-500 hover:bg-gray-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
                Volver a la lista de pagos
            </a>
        </div>
    </div>
</x-app-layout>
