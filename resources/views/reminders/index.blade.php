<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recordatorios') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Recordatorios</h1>

        <div class="mb-4">
            <a href="{{ route('reminders.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Crear Recordatorio
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Servicio</th>
                        <th class="px-4 py-2 border">Tipo</th>
                        <th class="px-4 py-2 border">Estado</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reminders as $reminder)
                    <tr>
                        <td class="px-4 py-2 border">{{ $reminder->id }}</td>
                        <td class="px-4 py-2 border">{{ $reminder->payment->serviceEntity->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border capitalize">{{ $reminder->reminder_type }}</td>
                        <td class="px-4 py-2 border">
                            <span class="{{ $reminder->status == 'active' ? 'text-green-500' : 'text-red-500' }}">
                                {{ ucfirst($reminder->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border text-center">
                            <a href="{{ route('reminders.show', $reminder->id) }}" class="text-blue-500 hover:underline">Ver</a>
                            <a href="{{ route('reminders.edit', $reminder->id) }}" class="text-yellow-500 hover:underline">Editar</a>
                            <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este recordatorio?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">No tienes recordatorios registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <div class="mt-4">
                {{ $reminders->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 