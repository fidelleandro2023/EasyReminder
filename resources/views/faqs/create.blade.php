<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Pregunta Frecuente') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ route('help-faq.store') }}" method="POST">
                @csrf
                <label class="block">Pregunta:</label>
                <input type="text" name="question" class="border px-3 py-2 rounded w-full mb-2" required>

                <label class="block">Respuesta:</label>
                <textarea name="answer" class="border px-3 py-2 rounded w-full mb-2" required></textarea>

                <label class="block">Orden:</label>
                <input type="number" name="order" class="border px-3 py-2 rounded w-full mb-2">

                <label class="block">
                    <input type="checkbox" name="is_active" value="1" checked> Activo
                </label>

                <div class="flex justify-end mt-4">
                    <a href="{{ route('help-faq.index') }}" class="mr-2 text-gray-600">Cancelar</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
