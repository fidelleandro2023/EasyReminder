<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categoría de Ayuda') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">✏️ Editar Categoría de Ayuda</h1>
        
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <strong>Errores:</strong>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('help-categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-300 @error('name') border-red-500 @enderror">
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-300 @error('slug') border-red-500 @enderror">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" id="description"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-300 @error('description') border-red-500 @enderror">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="status" id="status" class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-300">
                    <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="icon" class="block text-sm font-medium text-gray-700">Ícono (opcional)</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $category->icon) }}"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-300 @error('icon') border-red-500 @enderror">
            </div>

            <div class="mb-4">
                <label for="order" class="block text-sm font-medium text-gray-700">Orden</label>
                <input type="number" name="order" id="order" value="{{ old('order', $category->order) }}"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-indigo-300 @error('order') border-red-500 @enderror">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                    Actualizar
                </button>
                <a href="{{ route('help-categories.index') }}" class="text-gray-700 hover:underline">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
