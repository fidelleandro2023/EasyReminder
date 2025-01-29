<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pagos recurrentes') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Editar Pago Recurrente</h1>

        <form action="{{ route('recurring-payments.update', $recurringPayment->id) }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-6">
            @csrf
            @method('PUT')

            <!-- Servicio -->
            <div>
                <label for="service_entity_id" class="block font-semibold mb-1">Servicio:</label>
                <select name="service_entity_id" id="service_entity_id" class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                    <option value="">-- Ninguno --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" class="font-bold" data-category="{{ $category->name }}">
                            {{ $category->name }}
                        </option>
                        @foreach ($category->services as $service)
                            <option value="{{ $service->id }}" data-category="{{ $category->name }}" {{ old('parent_id') == $service->id ? 'selected' : '' }}>
                                &nbsp;&nbsp;&nbsp;{{ $service->name }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
                @error('parent_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div> 

            <!-- Monto -->
            <div>
                <label for="amount" class="block font-semibold mb-1">Monto (S/.):</label>
                <input type="number" step="0.01" name="amount" id="amount" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    value="{{ old('amount', $recurringPayment->amount) }}" placeholder="Ejemplo: 150.00">
                @error('amount')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Frecuencia -->
            <div>
                <label for="frequency" class="block font-semibold mb-1">Frecuencia:</label>
                <select name="frequency" id="frequency" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                    <option value="daily" {{ $recurringPayment->frequency == 'daily' ? 'selected' : '' }}>Diaria</option>
                    <option value="weekly" {{ $recurringPayment->frequency == 'weekly' ? 'selected' : '' }}>Semanal</option>
                    <option value="monthly" {{ $recurringPayment->frequency == 'monthly' ? 'selected' : '' }}>Mensual</option>
                    <option value="yearly" {{ $recurringPayment->frequency == 'yearly' ? 'selected' : '' }}>Anual</option>
                </select>
                @error('frequency')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de inicio -->
            <div>
                <label for="start_date" class="block font-semibold mb-1">Fecha de Inicio:</label>
                <input type="date" name="start_date" id="start_date" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    value="{{ old('start_date', $recurringPayment->start_date) }}">
                @error('start_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de fin -->
            <div>
                <label for="end_date" class="block font-semibold mb-1">Fecha de Fin (Opcional):</label>
                <input type="date" name="end_date" id="end_date" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    value="{{ old('end_date', $recurringPayment->end_date) }}">
                @error('end_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Estado -->
            <div>
                <label for="status" class="block font-semibold mb-1">Estado:</label>
                <select name="status" id="status" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                    <option value="active" {{ $recurringPayment->status == 'active' ? 'selected' : '' }}>Activo</option>
                    <option value="inactive" {{ $recurringPayment->status == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('status')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Guardar Cambios
                </button>
                <a href="{{ route('recurring-payments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>

<script src="{{ asset('js/select2/js/select2.min.js') }}"></script>
<link href="{{ asset('js/select2/css/select2.min.css') }}" rel="stylesheet" />

<script>
    $(document).ready(function() {
        function customMatcher(params, data) {
            if ($.trim(params.term) === '') {
                return data;
            }

            let term = params.term.toLowerCase();
            let text = data.text.toLowerCase();
            let category = $(data.element).data('category') ? $(data.element).data('category').toLowerCase() : '';

            if (text.includes(term) || category.includes(term)) {
                return data;
            }

            return null;
        }

        $('#service_entity_id').select2({
            placeholder: 'Seleccione un servicio',
            allowClear: true,
            width: '100%',
            matcher: customMatcher,
            templateResult: function (data) {
                if (!data.id) {
                    return data.text;
                }

                let $element = $(data.element);
                let category = $element.data('category');
                let padding = category ? 'padding-left: 20px;' : 'font-weight: bold;';

                return $('<span style="' + padding + '">' + data.text + '</span>');
            },
            templateSelection: function (data) {
                return data.text;
            }
        });
    });
</script>