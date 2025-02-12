<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Categoría de Ayuda') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">📂 {{ $category->name }}</h1>

        <div class="mb-4">
            <p class="text-gray-700"><strong>Slug:</strong> {{ $category->slug }}</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-700"><strong>Descripción:</strong> {{ $category->description ?? 'Sin descripción' }}</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-700"><strong>Estado:</strong> 
                <span class="px-2 py-1 text-sm rounded-lg 
                    {{ $category->status ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                    {{ $category->status ? 'Activo' : 'Inactivo' }}
                </span>
            </p>
        </div>

        <div class="mb-4">
            <p class="text-gray-700"><strong>Ícono:</strong> {{ $category->icon ?? 'No especificado' }}</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-700"><strong>Orden:</strong> {{ $category->order ?? 'No especificado' }}</p>
        </div>

        <div class="mb-4">
            <p class="text-gray-700"><strong>Creado por (ID usuario):</strong> {{ $category->created_by }}</p>
        </div>

        <div class="mb-6">
            <p class="text-gray-700"><strong>Fecha de creación:</strong> {{ $category->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mt-6 mb-4">📜 Guías relacionadas</h2>
        @if ($category->guides->isEmpty())
            <p class="text-gray-600">No hay guías registradas en esta categoría.</p>
        @else
            <ul class="list-disc pl-5">
                @foreach ($category->guides as $guide)
                    <li>
                        <a href="{{ route('help_guides.show', $guide->id) }}" 
                           class="text-indigo-600 hover:underline">{{ $guide->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <h2 class="text-2xl font-bold text-gray-800 mt-6 mb-4">❓ Preguntas Frecuentes</h2>
        @if ($category->faqs->isEmpty())
            <p class="text-gray-600">No hay preguntas frecuentes registradas.</p>
        @else
            <ul class="list-disc pl-5">
                @foreach ($category->faqs as $faq)
                    <li>{{ $faq->question }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mt-6 flex items-center space-x-4">
            <a href="{{ route('help_categories.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                Volver
            </a>
            <a href="{{ route('help_categories.edit', $category->id) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Editar
            </a>
            <form action="{{ route('help_categories.destroy', $category->id) }}" method="POST" 
                  onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                    Eliminar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
