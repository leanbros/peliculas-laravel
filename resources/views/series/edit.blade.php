<!-- resources/views/series/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Serie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('series.update', ['serie' => $serie->id]) }}" method="POST" enctype="multipart/form-data"> 
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $serie->title) }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 text-black">
                        </div>

                        <div class="mb-4">
                            <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $serie->slug) }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 text-black">
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="description" id="description" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 text-black">{{ old('description', $serie->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                            <input type="file" name="image" id="image" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 text-black">
                            @if ($serie->image)
                                <img src="{{ asset('images/' . $serie->image) }}" alt="{{ $serie->title }}" class="mt-2 h-20">
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                            <select name="category_id" id="category_id" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 text-black">
                                @foreach ($categorias as $id => $titulo)
                                    <option value="{{ $id }}" {{ $serie->category_id == $id ? 'selected' : '' }}>
                                        {{ $titulo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="temporadas" class="block text-sm font-medium text-gray-700">Temporadas</label>
                            <select name="temporada_id" id="temporadas" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 text-black">
                                @foreach ($temporadas as $temporada)
                                    <option value="{{ $temporada->id }}">{{ $temporada->title }} - Temporada {{ $temporada->season_number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sección para agregar capítulos -->
                        <div class="mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Agregar Capítulos</h3>
                            <div id="capitulos">
                                <!-- Aquí se pueden añadir capítulos dinámicamente con JavaScript -->
                            </div>
                            <button type="button" onclick="addCapitulo()">Agregar Capítulo</button>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addCapitulo() {
            const container = document.getElementById('capitulos');
            const index = container.children.length;

            const html = `
                <div class="mb-4">
                    <label for="capitulo_title_${index}" class="block text-sm font-medium text-gray-700">Título del Capítulo ${index + 1}</label>
                    <input type="text" name="capitulos[${index}][title]" id="capitulo_title_${index}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 text-black">
                </div>
                <div class="mb-4">
                    <label for="capitulo_episode_number_${index}" class="block text-sm font-medium text-gray-700">Número del Capítulo ${index + 1}</label>
                    <input type="number" name="capitulos[${index}][episode_number]" id="capitulo_episode_number_${index}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 text-black">
                </div>
                <div class="mb-4">
                    <label for="capitulo_description_${index}" class="block text-sm font-medium text-gray-700">Descripción del Capítulo ${index + 1}</label>
                    <textarea name="capitulos[${index}][description]" id="capitulo_description_${index}" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 text-black"></textarea>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
</x-app-layout>
