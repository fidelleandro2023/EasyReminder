<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6 space-y-8">
                
                <!-- Resumen general -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Pagos Pendientes -->
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4">
                        <div class="flex items-center">
                            <div class="text-yellow-500">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold">Pagos Pendientes</h4>
                                <p class="text-2xl font-bold">{{ $pendingPaymentsCount }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Pagos Realizados -->
                    <div class="bg-green-100 border-l-4 border-green-500 p-4">
                        <div class="flex items-center">
                            <div class="text-green-500">
                                <i class="fas fa-check fa-2x"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold">Pagos Realizados</h4>
                                <p class="text-2xl font-bold">{{ $paidPaymentsCount }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Pagos Vencidos -->
                    <div class="bg-red-100 border-l-4 border-red-500 p-4">
                        <div class="flex items-center">
                            <div class="text-red-500">
                                <i class="fas fa-exclamation-circle fa-2x"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold">Pagos Vencidos</h4>
                                <p class="text-2xl font-bold">{{ $overduePaymentsCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post-its virtuales -->
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-gray-800">Recordatorios Prioritarios</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($priorityPayments as $payment)
                        <div class="bg-white shadow-lg p-4 rounded-lg border-l-4 
                            @if ($payment->status == 'overdue') border-red-500 
                            @elseif ($payment->due_date <= now()->addDays(1)) border-yellow-500 
                            @else border-green-500 @endif">
                            <h4 class="text-lg font-semibold">{{ $payment->serviceEntity->name }}</h4>
                            <p class="text-sm text-gray-600">Monto: S/. {{ number_format($payment->amount, 2) }}</p>
                            <p class="text-sm text-gray-600">Fecha: {{ $payment->due_date }}</p>
                            <p class="mt-2">
                                @if ($payment->status == 'pending')
                                <span class="text-yellow-500 font-bold">Pendiente</span>
                                @elseif ($payment->status == 'paid')
                                <span class="text-green-500 font-bold">Pagado</span>
                                @elseif ($payment->status == 'overdue')
                                <span class="text-red-500 font-bold">Vencido</span>
                                @endif
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Accesos rápidos -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('payments.create') }}" class="bg-blue-500 text-white py-3 px-4 rounded-lg text-center hover:bg-blue-600">
                        <i class="fas fa-plus"></i> Nuevo Pago
                    </a>
                    <a href="{{ route('payments.index') }}" class="bg-gray-500 text-white py-3 px-4 rounded-lg text-center hover:bg-gray-600">
                        <i class="fas fa-list"></i> Ver Lista de Pagos
                    </a>
                    <a href="{{ route('payment_histories.index') }}" class="bg-green-500 text-white py-3 px-4 rounded-lg text-center hover:bg-green-600">
                        <i class="fas fa-history"></i> Ver Historial
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
