<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Crear Menú</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('menus.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Menú</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="text" name="url" id="url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('url') }}" required>
                </div>

                <div class="mb-4">
                    <label for="icon" class="block text-sm font-medium text-gray-700">Ícono</label>
                    <input type="text" name="icon" id="icon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Ej: fas fa-home" value="{{ old('icon') }}">
                </div>

                <div class="mb-4">
                    <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
                    <select name="roles[]" id="roles" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" multiple>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-gray-500">Mantén presionada la tecla <strong>Ctrl</strong> (o <strong>Cmd</strong> en Mac) para seleccionar varios roles.</small>
                </div>

                <div class="mb-4">
                    <label for="permissions" class="block text-sm font-medium text-gray-700">Permisos</label>
                    <select name="permissions[]" id="permissions" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" multiple>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-gray-500">Mantén presionada la tecla <strong>Ctrl</strong> (o <strong>Cmd</strong> en Mac) para seleccionar varios permisos.</small>
                </div>

                <div class="mb-4">
                    <label for="order" class="block text-sm font-medium text-gray-700">Orden</label>
                    <input type="number" name="order" id="order" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('order', 0) }}">
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('menus.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
