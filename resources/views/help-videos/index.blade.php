<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Videos de Ayuda') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6">
        <a href="{{ route('help-videos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Video</a>

        <div class="mt-4">
            @foreach ($videos as $video)
                <div class="p-4 border rounded mb-4">
                    <h3 class="text-lg font-semibold">{{ $video->title }}</h3>
                    <p>{{ $video->description }}</p>
                    <iframe width="560" height="315" src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                    <div class="mt-2">
                        <a href="{{ route('help-videos.show', $video) }}" class="text-blue-600">Ver</a> |
                        <a href="{{ route('help-videos.edit', $video) }}" class="text-yellow-600">Editar</a> |
                        <form action="{{ route('help-videos.destroy', $video) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $videos->links() }}
    </div>
</x-app-layout>
