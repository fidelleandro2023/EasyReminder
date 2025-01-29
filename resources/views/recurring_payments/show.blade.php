<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Pago Recurrente') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Detalle del Pago Recurrente</h1>
        
        <div class="bg-white p-6 shadow rounded-lg space-y-4">
            <div>
                <strong>Servicio:</strong>
                <p>{{ $recurringPayment->serviceEntity->name ?? 'No asignado' }}</p>
            </div>
            <div>
                <strong>Monto (S/.):</strong>
                <p>{{ number_format($recurringPayment->amount, 2) }}</p>
            </div>
            <div>
                <strong>Frecuencia:</strong>
                <p>
                    @switch($recurringPayment->frequency)
                        @case('daily') Diaria @break
                        @case('weekly') Semanal @break
                        @case('monthly') Mensual @break
                        @case('yearly') Anual @break
                        @default Desconocida
                    @endswitch
                </p>
            </div>
            <div>
                <strong>Fecha de Inicio:</strong>
                <p>{{ $recurringPayment->start_date }}</p>
            </div>
            <div>
                <strong>Fecha de Fin:</strong>
                <p>{{ $recurringPayment->end_date ?? 'No especificada' }}</p>
            </div>
            <div>
                <strong>Estado:</strong>
                <p class="{{ $recurringPayment->status == 'active' ? 'text-green-500' : 'text-red-500' }}">
                    {{ $recurringPayment->status == 'active' ? 'Activo' : 'Inactivo' }}
                </p>
            </div>
        </div>

        <div class="mt-6 flex space-x-4">
            <a href="{{ route('recurring_payments.edit', $recurringPayment->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Editar
            </a>
            <a href="{{ route('recurring_payments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                Volver
            </a>
        </div>
    </div>
</x-app-layout>