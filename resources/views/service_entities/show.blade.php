<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de Entidad de Servicio') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Detalles de la Entidad de Servicio</h1>

        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <div class="mb-4">
                <h3 class="text-xl font-semibold">Nombre:</h3>
                <p>{{ $serviceEntity->name }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-xl font-semibold">Descripción:</h3>
                <p>{{ $serviceEntity->description ?? 'Sin descripción' }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-xl font-semibold">Categoría:</h3>
                <p>{{ $serviceEntity->parent ? $serviceEntity->parent->name : 'N/A' }}</p>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('service_entities.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Regresar a la lista
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
