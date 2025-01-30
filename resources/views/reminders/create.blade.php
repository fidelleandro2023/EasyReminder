<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recordatorios') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Crear Recordatorio</h1>

        @if ($errors->has('payment_id'))
            <div class="text-red-500 text-sm">{{ $errors->first('payment_id') }}</div>
        @endif

        <form action="{{ route('reminders.store') }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-6">
            @csrf
            <input type="hidden" name="reminder_types[]" value="">
            <!-- Mensaje de ayuda -->
            <div class="p-4 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg text-sm">
                Puede seleccionar **un pago único**, **un pago recurrente**, o **ambos**. Si no selecciona ninguno, se mostrará un error.
            </div>

            <!-- Checkbox para seleccionar ambos pagos -->
            <div class="flex items-center space-x-3">
                <input type="checkbox" id="select_both" class="h-5 w-5 text-blue-500">
                <label for="select_both" class="text-gray-700 font-medium">Quiero seleccionar un pago único y un pago recurrente</label>
            </div>

            <!-- Selección de pago único -->
            <div id="payment_section">
                <label for="payment_id" class="block font-semibold mb-1">Pago Único Asociado:</label>
                <select name="payment_id" id="payment_id"
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200 select2">
                    <option value="">Seleccione un pago único</option>
                    @foreach ($payments as $payment)
                        <option value="{{ $payment->id }}" {{ old('payment_id') == $payment->id ? 'selected' : '' }}>
                            {{ $payment->serviceEntity->name }} - S/. {{ number_format($payment->amount, 2) }}
                        </option>
                    @endforeach
                </select>
                <p class="text-gray-500 text-sm mt-1">Seleccione un pago único si es un cobro puntual.</p>
                @error('payment_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Selección de pago recurrente -->
            <div id="recurring_payment_section">
                <label for="recurring_payment_id" class="block font-semibold mb-1">Pago Recurrente Asociado:</label>
                <select name="recurring_payment_id" id="recurring_payment_id"
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200 select2">
                    <option value="">Seleccione un pago recurrente</option>
                    @foreach ($recurringPayments as $recurringPayment)
                        <option value="{{ $recurringPayment->id }}" {{ old('recurring_payment_id') == $recurringPayment->id ? 'selected' : '' }}>
                            {{ $recurringPayment->serviceEntity->name }} - S/. {{ number_format($recurringPayment->amount, 2) }}
                        </option>
                    @endforeach
                </select>
                <p class="text-gray-500 text-sm mt-1">Seleccione un pago recurrente si se repite periódicamente.</p>
                @error('recurring_payment_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tipo de recordatorio (selección múltiple) -->
            <div>
                <label class="block font-semibold mb-1">Tipos de Recordatorio:</label>
                <div class="flex items-center space-x-4">
                    <label>
                        <input type="checkbox" name="reminder_types[]" value="email"
                            {{ is_array(old('reminder_types')) && in_array('email', old('reminder_types')) ? 'checked' : '' }}>
                        Email
                    </label>
                    <label>
                        <input type="checkbox" name="reminder_types[]" value="push"
                            {{ is_array(old('reminder_types')) && in_array('push', old('reminder_types')) ? 'checked' : '' }}>
                        Notificación Push
                    </label>
                    <label>
                        <input type="checkbox" name="reminder_types[]" value="sms"
                            {{ is_array(old('reminder_types')) && in_array('sms', old('reminder_types')) ? 'checked' : '' }}>
                        SMS
                    </label>
                </div>
                @error('reminder_types')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha del recordatorio -->
            <div>
                <label for="reminder_date" class="block font-semibold mb-1">Fecha de Recordatorio:</label>
                <input type="date" name="reminder_date" id="reminder_date"
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
                    value="{{ old('reminder_date', now()->toDateString()) }}" required>
                @error('reminder_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Estado -->
            <div>
                <label for="status" class="block font-semibold mb-1">Estado:</label>
                <select name="status" id="status"
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200 select2">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Activo</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Guardar Recordatorio
                </button>
                <a href="{{ route('reminders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>

<!-- Select2 -->
<script src="{{ asset('js/select2/js/select2.min.js') }}"></script>
<link href="{{ asset('js/select2/css/select2.min.css') }}" rel="stylesheet" />

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });

        // Checkbox para permitir selección de ambos pagos
        $('#select_both').change(function() {
            if ($(this).is(':checked')) {
                $('#payment_id, #recurring_payment_id').prop('disabled', false);
            } else {
                $('#payment_id, #recurring_payment_id').val(null).trigger('change');
            }
        });

        // Validación visual en el formulario
        $('form').submit(function(event) {
            let paymentSelected = $('#payment_id').val();
            let recurringPaymentSelected = $('#recurring_payment_id').val();

            if (!paymentSelected && !recurringPaymentSelected) {
                event.preventDefault();
                $('#payment_id, #recurring_payment_id').addClass('border-red-500');
                alert('Debe seleccionar al menos un pago único o un pago recurrente.');
            } else {
                $('#payment_id, #recurring_payment_id').removeClass('border-red-500');
            }
        });
    });
</script>