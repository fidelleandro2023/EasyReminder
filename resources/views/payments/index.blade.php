<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pagos') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Lista de Pagos</h1>

        <!-- Botón para crear un nuevo pago -->
        <div class="mb-4">
            <a href="{{ route('payments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Crear Nuevo Pago
            </a>
            <a href="{{ route('payments.overdue') }}" class="btn btn-danger">Ver pagos vencidos</a>

        </div>

        <!-- Tabla de pagos -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Usuario</th>
                        <th class="px-4 py-2 border">Servicio</th>
                        <th class="px-4 py-2 border">Monto</th>
                        <th class="px-4 py-2 border">Fecha de Vencimiento</th>
                        <th class="px-4 py-2 border">Estado</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border text-center">{{ $payment->id }}</td>
                        <td class="px-4 py-2 border text-center">{{ $payment->user->name }}</td>
                        <td class="px-4 py-2 border text-center">{{ $payment->serviceEntity->name }}</td>
                        <td class="px-4 py-2 border text-center">S/. {{ number_format($payment->amount, 2) }}</td>
                        <td class="px-4 py-2 border text-center">{{ $payment->due_date }}</td>
                        <td class="px-4 py-2 border text-center">
                            @if ($payment->status === 'pending')
                            <span class="text-yellow-500 font-semibold">Pendiente</span>
                            @elseif ($payment->status === 'paid')
                            <span class="text-green-500 font-semibold">Pagado</span>
                            @elseif ($payment->status === 'overdue')
                            <span class="text-red-500 font-semibold">Vencido</span>
                            @elseif ($payment->status === 'deleted')
                            <span class="text-gray-500 font-semibold">Eliminado</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('payments.edit', $payment->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">
                                    Editar
                                </a>
                                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este pago?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center text-gray-500">No hay pagos registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <div class="mt-4">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
