<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Video de Ayuda') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <form action="{{ route('help-videos.update', $video) }}" method="POST">
            @csrf @method('PUT')

            <div>
                <label for="title">Título</label>
                <input type="text" name="title" id="title" value="{{ $video->title }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label for="url">URL del Video</label>
                <input type="text" name="url" id="url" value="{{ $video->url }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="w-full border rounded p-2">{{ $video->description }}</textarea>
            </div>

            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded mt-4">Actualizar</button>
        </form>
    </div>
</x-app-layout>
