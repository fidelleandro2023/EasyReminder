<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Análisis de Gastos') }}
        </h2>
    </x-slot>
    @section('title', isset($category) ? 'Editar Categoría' : 'Nueva Categoría')
 
    <div class="container bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4">
            {{ isset($category) ? 'Editar Categoría' : 'Nueva Categoría' }}
        </h2>

        <form action="{{ isset($category) ? route('help_categories.update', $category->id) : route('help_categories.store') }}" method="POST">
            @csrf
            @isset($category)
                @method('PUT')
            @endisset

            <div class="mb-4">
                <label class="block font-semibold">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Descripción</label>
                <textarea name="description" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description', $category->description ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Estado</label>
                <select name="status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="1" {{ isset($category) && $category->status ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ isset($category) && !$category->status ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Ícono (URL o clase CSS)</label>
                <input type="text" name="icon" value="{{ old('icon', $category->icon ?? '') }}" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Orden</label>
                <input type="number" name="order" value="{{ old('order', $category->order ?? 0) }}" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('help_categories.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>