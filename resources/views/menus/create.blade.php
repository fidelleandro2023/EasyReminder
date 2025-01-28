<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Crear Menú</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('menus.store') }}" method="POST">
                @csrf
                <!-- Nombre del Menú -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Menú</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('name') }}" required>
                </div>

                <!-- URL -->
                <div class="mb-4">
                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="text" name="url" id="url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('url') }}" required>
                </div>

                <!-- Ícono -->
                <div class="mb-4">
                    <label for="icon" class="block text-sm font-medium text-gray-700">Ícono</label>
                    <input type="text" name="icon" id="icon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Ej: fas fa-home" value="{{ old('icon') }}">
                </div>

                <!-- Roles -->
                <div class="mb-4">
                    <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
                    <select name="roles[]" id="roles" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" multiple>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-gray-500">Seleccione uno o más roles.</small>
                </div>

                <!-- Permisos -->
                <div class="mb-4">
                    <label for="permissions" class="block text-sm font-medium text-gray-700">Permisos</label>
                    <select name="permissions[]" id="permissions" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" multiple>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-gray-500">Seleccione uno o más permisos.</small>
                </div>

                <!-- Menú Padre -->
                <div class="mb-4">
                    <label for="parent_id" class="block text-sm font-medium text-gray-700">Menú Padre</label>
                    <select name="parent_id" id="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Sin menú padre</option>
                        @foreach ($menuTree as $parentMenu)
                            <option value="{{ $parentMenu->id }}">{{ $parentMenu->name }}</option>
                            @if ($parentMenu->children)
                                @foreach ($parentMenu->children as $childMenu)
                                    <option value="{{ $childMenu->id }}">&nbsp;&nbsp;&nbsp;└ {{ $childMenu->name }}</option>
                                    @if ($childMenu->children)
                                        @foreach ($childMenu->children as $subChildMenu)
                                            <option value="{{ $subChildMenu->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ {{ $subChildMenu->name }}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Orden -->
                <div class="mb-4">
                    <label for="order" class="block text-sm font-medium text-gray-700">Orden</label>
                    <input type="number" name="order" id="order" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('order', 0) }}">
                </div>

                <!-- Botones -->
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

<script src="{{ asset('js/select2/js/select2.min.js') }}"></script>
<link href="{{ asset('js/select2/css/select2.min.css') }}" rel="stylesheet" />
<script>
    $(document).ready(function() {
        // Configuración para Select2 en parent_id
        $('#parent_id').select2({
            placeholder: 'Sin Menú padre',
            allowClear: true,
            width: '100%'
        });

        // Configuración para Select2 en permissions
        $('#permissions').select2({
            placeholder: 'Seleccione uno o más permisos',
            allowClear: true,
            width: '100%'
        });

        // Configuración para Select2 en roles
        $('#roles').select2({
            placeholder: 'Seleccione uno o más roles',
            allowClear: true,
            width: '100%'
        });
    });
</script>
