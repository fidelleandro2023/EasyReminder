<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6 space-y-8">
                <!-- Tabs -->
                <div>
                    <ul class="flex border-b" id="tabs">
                        <li class="mr-1">
                            <button id="regular-tab" class="bg-gray-200 inline-block px-4 py-2 text-gray-600 font-semibold active-tab">
                                Pagos Regulares
                            </button>
                        </li>
                        <li>
                            <button id="recurring-tab" class="bg-gray-200 inline-block px-4 py-2 text-gray-600 font-semibold">
                                Pagos Recurrentes
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Contenido de los Tabs -->
                <div id="regular-payments" class="tab-content">
                    <div class="space-y-4"> 
                        <!-- Sección de Pagos Regulares -->
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
                        <!-- Accesos rápidos -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6"> 
                                <a href="{{ route('payments.create') }}" class="bg-blue-500 text-white py-3 px-4 rounded-lg text-center hover:bg-blue-600">
                                    <i class="fas fa-plus"></i> Nuevo Pago
                                </a>
                                <a href="{{ route('payments.index') }}" class="bg-gray-500 text-white py-3 px-4 rounded-lg text-center hover:bg-gray-600">
                                    <i class="fas fa-list"></i> Ver Lista de Pagos
                                </a>
                                <a href="{{ route('recurring_payments.index') }}" class="bg-green-500 text-white py-3 px-4 rounded-lg text-center hover:bg-green-600">
                                    <i class="fas fa-redo"></i> Ver Pagos vencidos
                                </a>
                        </div>
                    </div>
                </div>

                <div id="recurring-payments" class="tab-content hidden">
                    <!-- Sección de Pagos Recurrentes -->
                    <div class="space-y-4"> 
                        <!-- Resumen de Pagos Recurrentes -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Pagos Activos -->
                            <div class="bg-blue-100 border-l-4 border-blue-500 p-4">
                                <div class="flex items-center">
                                    <div class="text-blue-500">
                                        <i class="fas fa-play fa-2x"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold">Pagos Activos</h4>
                                        <p class="text-2xl font-bold">{{ $activeRecurringPaymentsCount }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Pagos Pausados -->
                            <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4">
                                <div class="flex items-center">
                                    <div class="text-yellow-500">
                                        <i class="fas fa-pause fa-2x"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold">Pagos Pausados</h4>
                                        <p class="text-2xl font-bold">{{ $pausedRecurringPaymentsCount }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Pagos Completados -->
                            <div class="bg-green-100 border-l-4 border-green-500 p-4">
                                <div class="flex items-center">
                                    <div class="text-green-500">
                                        <i class="fas fa-check fa-2x"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold">Pagos Completados</h4>
                                        <p class="text-2xl font-bold">{{ $completedRecurringPaymentsCount }}</p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <!-- Lista Detallada de Pagos Recurrentes -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($recurringPayments as $payment)
                            <div class="bg-white shadow-lg p-4 rounded-lg border-l-4 
                                @if ($payment->status == 'completed') border-green-500 
                                @elseif ($payment->status == 'paused') border-yellow-500 
                                @else border-blue-500 @endif">
                                <h4 class="text-lg font-semibold">{{ $payment->serviceEntity->name }}</h4>
                                <p class="text-sm text-gray-600">Monto: S/. {{ number_format($payment->amount, 2) }}</p>
                                <p class="text-sm text-gray-600">Próximo Pago: {{ $payment->next_due_date }}</p>
                                <p class="mt-2">
                                    @if ($payment->status == 'active')
                                    <span class="text-blue-500 font-bold">Activo</span>
                                    @elseif ($payment->status == 'paused')
                                    <span class="text-yellow-500 font-bold">Pausado</span>
                                    @elseif ($payment->status == 'completed')
                                    <span class="text-green-500 font-bold">Completado</span>
                                    @endif
                                </p>
                            </div>
                            @endforeach
                        </div> 
                        <!-- Accesos rápidos -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <a href="{{ route('recurring_payments.create') }}" class="bg-blue-500 text-white py-3 px-4 rounded-lg text-center hover:bg-blue-600">
                                <i class="fas fa-plus"></i> Nuevo Pago Recurrente
                            </a>
                            <a href="{{ route('recurring_payments.index') }}" class="bg-gray-500 text-white py-3 px-4 rounded-lg text-center hover:bg-gray-600">
                                <i class="fas fa-list"></i> Ver Lista de Pagos
                            </a>
                            <a href="{{ route('recurring_payments.index') }}" class="bg-green-500 text-white py-3 px-4 rounded-lg text-center hover:bg-green-600">
                                <i class="fas fa-redo"></i> Ver Pagos Recurrentes
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('#tabs button');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active-tab'));
                    // Hide all tab contents
                    contents.forEach(c => c.classList.add('hidden'));

                    // Add active class to the clicked tab and show its content
                    tab.classList.add('active-tab');
                    contents[index].classList.remove('hidden');
                });
            });
        });
    </script>

    <style>
        .active-tab {
            background-color: white;
            border: 1px solid #d1d5db;
            border-bottom: none;
            border-radius: 0.375rem 0.375rem 0 0;
        }

        .tab-content.hidden {
            display: none;
        }
    </style>
</x-app-layout>
