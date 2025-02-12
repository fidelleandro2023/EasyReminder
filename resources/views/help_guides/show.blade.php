<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documentación') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $guide->title }}</h1>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
            <p class="text-lg font-semibold text-gray-700">
                📂 <strong>Categoría:</strong> {{ $guide->category->name ?? 'Sin categoría' }}
            </p>
            <p class="text-lg text-gray-600">
                👀 <strong>Vistas:</strong> {{ $guide->views }}
            </p>

            @if($guide->video_url)
                <div class="mt-4 aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-64 rounded-lg shadow-lg" src="{{ $guide->video_url }}" allowfullscreen></iframe>
                </div>
            @endif

            <div class="mt-4 text-gray-700 leading-relaxed">
                {!! nl2br(e($guide->content)) !!}
            </div>

            <div class="mt-6">
                <a href="{{ route('help_guides.index') }}" 
                   class="inline-block bg-gray-600 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-700 transition">
                   ⬅️ Volver
                </a>
            </div>
        </div>
    </div>
</x-app-layout>