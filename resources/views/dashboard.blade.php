<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 dark:text-gray-200 leading-tight">
            {{ __('Control de películas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-2xl font-bold mb-4">Películas</h1>

                    <!-- Botón Agregar -->
                    <a href="{{ route('posts.create') }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-block mb-4">
                        Agregar Pelicula
                    </a>
                    <!-- Botón Agregar Serie -->
                    <a href="{{ route('series.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block mb-4 ml-2">
                        Agregar Serie
                    </a>
                    <!-- Botón para visualizar las series -->
                    <a href="{{ route('series.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-4">Visualizar Series</a>

                    <!-- Mensaje de éxito -->
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif

                    <!-- Tabla de posts -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 mt-4">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Título</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Slug</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Descripción</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contenido</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Imagen</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Categoría</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                @foreach($data as $post)
                                <tr>
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $post->id }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $post->title }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $post->slug }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        <!-- Descripción corta con un enlace para ver más -->
                                        <div class="relative">
                                            <span
                                                class="block truncate">{{ Str::limit($post->description, 10, '...') }}</span>
                                            @if(Str::length($post->description) > 50)
                                            <a href="#"
                                                class="absolute right-0 top-1/2 transform -translate-y-1/2 text-blue-500 hover:text-blue-700 text-xs">Ver
                                                más</a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $post->content }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @if($post->image)
                                        <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}"
                                            class="w-24 h-16 object-cover">
                                        @else
                                        <span class="text-gray-500 dark:text-gray-400">Sin Imagen</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $post->category->titulo }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('posts.edit', $post->id) }}"
                                            class="text-yellow-500 hover:text-yellow-700 inline-flex items-center mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                class="w-6 h-6">
                                                <path
                                                    d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                    class="w-6 h-6">
                                                    <path fill="currentColor"
                                                        d="M400 64h-88v-8c0-17.7-14.3-32-32-32h-96c-17.7 0-32 14.3-32 32v8H48c-13.3 0-24 10.7-24 24v32c0 13.3 10.7 24 24 24h24v336c0 26.5 21.5 48 48 48h208c26.5 0 48-21.5 48-48V144h24c13.3 0 24-10.7 24-24v-32c0-13.3-10.7-24-24-24zM176 56c0-4.4 3.6-8 8-8h80c4.4 0 8 3.6 8 8v8h-96v-8zm184 432c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V144h280v344zm-40-224H128c-8.8 0-16-7.2-16-16s7.2-16 16-16h192c8.8 0 16 7.2 16 16s-7.2 16-16 16z" />
                                                </svg>
                                            </button>
                                        </form>


                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-4">
                        @if($data->count())
                        {{ $data->links('vendor.pagination.semantic-ui') }}
                        @else
                        <p>No hay posts disponibles.</p>
                        @endif
                    </div>

                </div>
                
                    
            </div>
        </div>
    </div>
</x-app-layout>

<style>
/* resources/css/app.css */
.bg-green-500 {
    background-color: #10b981;
}

.bg-green-700 {
    background-color: #059669;
}

.text-white {
    color: #ffffff;
}

.text-gray-900 {
    color: #1f2937;
}

.text-gray-500 {
    color: #6b7280;
}

.text-gray-100 {
    color: #f3f4f6;
}

.text-yellow-500 {
    color: #f59e0b;
}

.text-yellow-700 {
    color: #d97706;
}

.text-red-500 {
    color: #ef4444;
}

.text-red-700 {
    color: #dc2626;
}

.bg-gray-50 {
    background-color: #f9fafb;
}

.bg-gray-800 {
    background-color: #1f2937;
}
</style>