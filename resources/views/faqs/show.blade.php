<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de la Pregunta Frecuente') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold text-gray-900">{{ $faq->question }}</h3>
            
            <p class="mt-4 text-gray-700">{{ $faq->answer }}</p>

            <div class="mt-6 text-sm text-gray-500">
                <p><strong>Categoría:</strong> {{ $faq->category->name ?? 'Sin categoría' }}</p>
                <p><strong>Orden:</strong> {{ $faq->order }}</p>
                <p><strong>Estado:</strong> {{ $faq->is_active ? 'Activa' : 'Inactiva' }}</p>
                <p><strong>Vistas:</strong> {{ $faq->views }}</p>
            </div>

            <div class="mt-6 flex space-x-2">
                <a href="{{ route('faqs.edit', $faq->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Editar
                </a>

                <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta pregunta?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                        Eliminar
                    </button>
                </form>

                <a href="{{ route('faqs.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Volver
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
