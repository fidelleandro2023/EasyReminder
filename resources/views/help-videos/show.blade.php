<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $video->title }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <iframe width="560" height="315" src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
        <p class="mt-4">{{ $video->description }}</p>
        <p class="text-sm text-gray-500">Vistas: {{ $video->views }}</p>

        <a href="{{ route('help-videos.index') }}" class="text-blue-600">Volver</a>
    </div>
</x-app-layout>
