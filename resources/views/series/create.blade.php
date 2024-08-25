<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 dark:text-gray-200 leading-tight">
            {{ __('Crear Nueva Serie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('series.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="nombre_serie" class="block text-gray-700 dark:text-gray-300">Nombre de la
                                Serie</label>
                            <input type="text" id="nombre_serie" name="nombre_serie"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                value="{{ old('nombre_serie') }}" required>
                            @error('nombre_serie')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="descripcion" class="block text-gray-700 dark:text-gray-300">Descripción</label>
                            <textarea id="descripcion" name="descripcion" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="fecha_de_lanzamiento" class="block text-gray-700 dark:text-gray-300">Fecha de
                                Lanzamiento</label>
                            <input type="date" id="fecha_de_lanzamiento" name="fecha_de_lanzamiento"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                value="{{ old('fecha_de_lanzamiento') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                            <select id="category_id" name="category_id" class="form-select mt-1 block w-full">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->titulo }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-4">
                            <label for="" class="block text-gray-700 dark:text-gray-300">Imagen</label>
                            <input type="file" id="imagen" name="imagen"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        </div>

                        <div class="mb-4">
                            <label for="posted" class="block text-gray-700 dark:text-gray-300">Publicado</label>
                            <select id="posted" name="posted"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                <option value="yes">Sí</option>
                                <option value="not">No</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Crear Serie
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>