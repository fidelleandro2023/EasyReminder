<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Preguntas Frecuentes') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between mb-4">
                <input type="text" id="search" placeholder="Buscar..." class="border px-3 py-2 rounded w-1/3"
                    onkeyup="filterTable()">
                <a href="{{ route('help-faq.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nueva Pregunta</a>
            </div>

            @if (session('message'))
                <div class="bg-green-500 text-white p-2 mb-2 rounded">
                    {{ session('message') }}
                </div>
            @endif

            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Pregunta</th>
                        <th class="border p-2">Categoría</th>
                        <th class="border p-2">Orden</th>
                        <th class="border p-2">Estado</th>
                        <th class="border p-2">Acciones</th>
                    </tr>
                </thead>
                <tbody id="faqTable">
                    @foreach ($faqs as $faq)
                        <tr>
                            <td class="border p-2">{{ $faq->question }}</td>
                            <td class="border p-2">{{ $faq->category->name ?? 'Sin categoría' }}</td>
                            <td class="border p-2">{{ $faq->order }}</td>
                            <td class="border p-2">
                                <span class="{{ $faq->is_active ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $faq->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="border p-2">
                                <a href="{{ route('help-faq.edit', $faq->id) }}" class="text-blue-500">Editar</a>
                                <form action="{{ route('help-faq.destroy', $faq->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 ml-2" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $faqs->links() }}
            </div>
        </div>
    </div>

    <script>
        function filterTable() {
            let search = document.getElementById('search').value.toLowerCase();
            let rows = document.getElementById('faqTable').getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                let question = rows[i].getElementsByTagName('td')[0];
                if (question) {
                    let textValue = question.textContent || question.innerText;
                    rows[i].style.display = textValue.toLowerCase().includes(search) ? "" : "none";
                }
            }
        }
    </script>
</x-app-layout>
