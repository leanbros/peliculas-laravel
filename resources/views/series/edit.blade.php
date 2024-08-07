<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Serie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Editar Serie</h1>
                    <form action="{{ route('series.update', $serie->id) }}" method="POST" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf
                        @method('PUT')
                        <!-- Campos de edición de la serie -->
                        <div>
                            <label for="nombre_serie" class="block text-sm font-medium text-gray-700">Nombre de la
                                Serie</label>
                            <input type="text" name="nombre_serie"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                value="{{ $serie->nombre_serie }}">
                        </div>
                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="descripcion"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $serie->descripcion }}</textarea>
                        </div>
                        <div>
                            <label for="fecha_de_lanzamiento" class="block text-sm font-medium text-gray-700">Fecha de
                                Lanzamiento</label>
                            <input type="text" name="fecha_de_lanzamiento"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                value="{{ $serie->fecha_de_lanzamiento }}">
                        </div>
                        <div>
                            <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
                            <input type="file" name="imagen"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            @if($serie->imagen)
                            <img src="{{ asset('storage/series_images/' . $serie->imagen) }}"
                                alt="{{ $serie->nombre_serie }}" class="w-24 h-16 object-cover">
                            @endif
                        </div>
                        <div>
                            <label for="posted" class="block text-sm font-medium text-gray-700">Publicado</label>
                            <select name="posted"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                <option value="yes" {{ $serie->posted == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="not" {{ $serie->posted == 'not' ? 'selected' : '' }}>Not</option>
                            </select>
                        </div>
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                            <select name="category_id" id="category_id"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-white text-gray-900 dark:bg-gray-700 dark:text-gray-100">
                                @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ $serie->category_id == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Guardar Serie
                        </button>
                    </form>

                    <hr class="my-6">

                    <h2 class="text-xl font-bold mb-4">Agregar Temporada</h2>
                    <form action="{{ route('temporadas.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="serie_id" value="{{ $serie->id }}">
                        <div>
                            <label for="nombre_temporada" class="block text-sm font-medium text-gray-700">Nombre de la
                                Temporada</label>
                            <input type="text" name="nombre_temporada"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label for="fecha_de_lanzamiento" class="block text-sm font-medium text-gray-700">Fecha de
                                Lanzamiento</label>
                            <input type="text" name="fecha_de_lanzamiento"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <button type="submit"
                            class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Agregar Temporada
                        </button>
                    </form>

                    <hr class="my-6">

                    <h2 class="text-xl font-bold mb-4">Editar Temporadas Existentes</h2>
                    @foreach($serie->temporadas as $temporada)
                    <form action="{{ route('temporadas.update', $temporada->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="nombre_temporada" class="block text-sm font-medium text-gray-700">Nombre de la
                                Temporada</label>
                            <input type="text" name="nombre_temporada"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                value="{{ $temporada->nombre_temporada }}">
                        </div>
                        <div>
                            <label for="fecha_de_lanzamiento" class="block text-sm font-medium text-gray-700">Fecha de
                                Lanzamiento</label>
                            <input type="text" name="fecha_de_lanzamiento"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                value="{{ $temporada->fecha_de_lanzamiento }}">
                        </div>
                        <button type="submit"
                            class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Guardar Temporada
                        </button>
                    </form>
                    @endforeach

                    <hr class="my-6">

                    <h2 class="text-xl font-bold mb-4">Agregar Capítulos</h2>
                    <form action="{{ route('capitulos.storeMultiple') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="temporada_id" class="block text-sm font-medium text-gray-700">Temporada</label>
                            <select name="temporada_id"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                @foreach($serie->temporadas as $temporada)
                                <option value="{{ $temporada->id }}">{{ $temporada->nombre_temporada }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="capitulos-container" class="space-y-4">
                            <div class="capitulo-group flex space-x-4">
                                <div>
                                    <label for="titulo" class="block text-sm font-medium text-gray-700">Título del
                                        Capítulo</label>
                                    <input type="text" name="titulo[]"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                </div>
                                <div>
                                    <label for="numero_capitulo" class="block text-sm font-medium text-gray-700">Número
                                        del Capítulo</label>
                                    <input type="text" name="numero_capitulo[]"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                </div>
                                <div>
                                    <label for="url" class="block text-sm font-medium text-gray-700">URL del
                                        Capítulo</label>
                                    <input type="text" name="url[]"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-capitulo"
                            class="mt-2 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Agregar Capítulo
                        </button>
                        <button type="submit"
                            class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Guardar Capítulos
                        </button>
                    </form>

                    <hr class="my-6">

                    <h2 class="text-xl font-bold mb-4">Editar Capítulos Existentes</h2>

                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        <strong class="font-bold">{{ session('success') }}</strong>
                    </div>
                    @endif

                    @foreach($serie->temporadas as $temporada)
                    <h3 class="text-lg font-semibold">{{ $temporada->nombre_temporada }}</h3>
                    @foreach($temporada->capitulos as $capitulo)
                    <!-- Formulario para editar el capítulo -->
                    <form action="{{ route('capitulos.update', $capitulo->id) }}" method="POST" class="space-y-4 mb-6">
                        @csrf
                        @method('PATCH')
                        <div class="capitulo-group flex space-x-4">
                            <div>
                                <label for="titulo-{{ $capitulo->id }}"
                                    class="block text-sm font-medium text-gray-700">Título del Capítulo</label>
                                <input type="text" name="titulo" id="titulo-{{ $capitulo->id }}"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                    value="{{ $capitulo->titulo }}" required>
                            </div>
                            <div>
                                <label for="numero_capitulo-{{ $capitulo->id }}"
                                    class="block text-sm font-medium text-gray-700">Número del Capítulo</label>
                                <input type="text" name="numero_capitulo" id="numero_capitulo-{{ $capitulo->id }}"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                    value="{{ $capitulo->numero_capitulo }}" required>
                            </div>
                            <div>
                                <label for="url-{{ $capitulo->id }}" class="block text-sm font-medium text-gray-700">URL
                                    del Capítulo</label>
                                <input type="text" name="url" id="url-{{ $capitulo->id }}"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                                    value="{{ $capitulo->url }}" required>
                            </div>
                        </div>
                        <button type="submit"
                            class="mt-2 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Guardar Capítulo
                        </button>
                    </form>

                    <!-- Formulario para eliminar el capítulo -->
                    <form action="{{ route('capitulos.destroy', $capitulo->id) }}" method="POST"
                        class="mt-4 inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Eliminar Capítulo
                        </button>
                    </form>
                    @endforeach
                    @endforeach




                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
document.getElementById('add-capitulo').addEventListener('click', function() {
    var container = document.getElementById('capitulos-container');
    var newGroup = document.createElement('div');
    newGroup.classList.add('capitulo-group', 'flex', 'space-x-4');
    newGroup.innerHTML = `
        <div>
            <label for="titulo" class="block text-sm font-medium text-gray-700">Título del Capítulo</label>
            <input type="text" name="titulo[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
        </div>
        <div>
            <label for="numero_capitulo" class="block text-sm font-medium text-gray-700">Número del Capítulo</label>
            <input type="text" name="numero_capitulo[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
        </div>
        <div>
            <label for="url" class="block text-sm font-medium text-gray-700">URL del Capítulo</label>
            <input type="text" name="url[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
        </div>
    `;
    container.appendChild(newGroup);
});
</script>

<style>
select {
    background-color: white;
    color: black;
}

.dark-mode select {
    background-color: #2d2d2d;
    color: #ffffff;
}
</style>
</div>
</div>
</div>
</div>