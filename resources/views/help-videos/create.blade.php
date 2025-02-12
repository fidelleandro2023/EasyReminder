<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Video de Ayuda') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <form action="{{ route('help-videos.store') }}" method="POST">
            @csrf
            <div>
                <label for="title">Título</label>
                <input type="text" name="title" id="title" class="w-full border rounded p-2">
            </div>

            <div>
                <label for="url">URL del Video</label>
                <input type="text" name="url" id="url" class="w-full border rounded p-2">
            </div>

            <div>
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="w-full border rounded p-2"></textarea>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4">Guardar</button>
        </form>
    </div>
</x-app-layout>
