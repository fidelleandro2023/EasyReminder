<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Servicio') }}
        </h2> 
    </x-slot>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Crear Entidad de Servicio</h1>

        <form action="{{ route('service_entities.store') }}" method="POST" class="bg-white p-6 shadow rounded-lg space-y-6">
            @csrf

            <!-- Nombre de la Entidad -->
            <div>
                <label for="name" class="block font-semibold mb-1">Nombre del Servicio:</label>
                <input type="text" name="name" id="name" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    value="{{ old('name') }}" placeholder="Ejemplo: Agua, Luz, Teléfono">
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="block font-semibold mb-1">Descripción (Opcional):</label>
                <textarea name="description" id="description" 
                    class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200" 
                    placeholder="Breve descripción del servicio">{{ old('description') }}</textarea>
                @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <!-- Parent ID (Servicio Padre) -->
            <div>
                <label for="parent_id" class="block font-semibold mb-1">Servicio Padre (Opcional):</label>
                <select name="parent_id" id="parent_id" class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
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
            <!-- Botones -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Guardar Servicio
                </button>
                <a href="{{ route('service_entities.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
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

        $('#parent_id').select2({
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
