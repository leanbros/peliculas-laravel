<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased bg-gray-900 text-white">
    <div class="bg-gray-80 text-black/50 dark:bg-black dark:text-white/50">

        <header class="sticky top-0 left-0 w-full z-50 flex items-center justify-between py-4 bg-gray-800 shadow-md">
            <!-- Logo a la izquierda -->
            <div class="flex items-center">
                <a href="{{ url('/') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    <img src="{{ asset('images/logo3.png') }}" alt="Logo" class="h-16">
                </a>
            </div>
            <!-- Buscador en el centro -->
            <div class="flex-grow flex justify-center">
                <form action="{{ route('peliculas.lista') }}" method="GET" class="mb-8 w-1/2">
                    <div class="flex">
                        <input type="text" name="search" placeholder="¿Qué quieres ver hoy?"
                            class="px-4 py-2 border rounded-l-lg focus:outline-none text-black w-full">
                        <button type="submit"
                            class="rounded-md px-4 py-2 bg-gradient-to-r from-cyan-500 to-purple-500 text-white shadow-lg transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gradient-to-r hover:from-cyan-600 hover:to-purple-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-300 dark:bg-gradient-to-r dark:from-cyan-600 dark:to-purple-600 dark:text-white dark:hover:from-cyan-700 dark:hover:to-purple-700 dark:focus-visible:ring-cyan-400">Buscar</button>
                    </div>
                </form>
            </div>

            <div class="flex items-center justify-end lg:col-start-3 lg:justify-end mt-6">
                <!-- Menú de usuario -->
                <div class="p-4 rounded-lg shadow-md">
                    @if (Route::has('login'))
                    @auth
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    @if(Auth::user()->profile_picture)
                                    <img class="h-8 w-8 rounded-full"
                                        src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                        alt="{{ Auth::user()->name }}" />
                                    @else
                                    <svg class="fill-current h-8 w-8 rounded-full bg-gray-300 dark:bg-gray-700 text-gray-600 dark:text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    @endif
                                    <div class="ml-1">{{ Auth::user()->name }}</div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('dashboard')">
                                    {{ __('Panel') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Perfil') }}
                                </x-dropdown-link>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                     this.closest('form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-white bg-black transition hover:bg-red-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 dark:bg-gray-800 dark:hover:bg-red-500">
                            Ingresar
                        </a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-white bg-black transition hover:bg-red-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 dark:bg-gray-800 dark:hover:bg-red-500">
                            Registrarse
                        </a>
                        @endif
                    </div>
                    @endauth
                    @endif
                </div>
            </div>

        </header>

        <div class="container mx-auto pt-16">
            <!-- Cambiado py-12 a py-24 para más espacio arriba -->
            <h1 class="text-4xl font-bold mb-4 text-white">
                {{ $capitulo->temporada->serie->nombre_serie }} - {{ $capitulo->titulo }}
            </h1>

            <div class="relative overflow-hidden rounded-lg shadow-lg bg-gray-800">
                <iframe src="{{ $capitulo->url }}" sandbox="allow-same-origin allow-scripts" width="100%" height="600px"
                    scrolling="no" frameborder="0" allowfullscreen="true"></iframe>
            </div>

            <div class="mt-4">
                <p class="text-lg">{{ $capitulo->descripcion }}</p>
            </div>

            <div class="mt-8 flex justify-between">
                @if($capituloAnterior)
                <a href="{{ route('capitulos.show', $capituloAnterior->id) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg">Anterior</a>
                @endif

                @if($capituloSiguiente)
                <a href="{{ route('capitulos.show', $capituloSiguiente->id) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg">Siguiente</a>
                @endif
            </div>

            <div class="mt-8">
                <label for="temporada-select" class="block text-sm font-medium text-white">Seleccionar
                    Temporada:</label>
                <select id="temporada-select"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 bg-white text-gray-900 dark:bg-gray-700 dark:text-gray-100">
                    @foreach($temporadas as $temporada)
                    <option value="{{ $temporada->id }}">{{ $temporada->nombre_temporada }}</option>
                    @endforeach
                </select>
            </div>

            <div id="capitulos-container" class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Aquí se insertarán los capítulos mediante JavaScript -->
            </div>
            <!-- Agregar Comentario -->
            <div class="comment-section mb-4">
                <h3 class="text-xl font-semibold mb-4 text-white dark:text-gray-200">Agregar comentario:</h3>
                <form action="{{ route('capituloComments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="capitulo_id" value="{{ $capitulo->id }}">
                    <div class="form-group mb-4">
                        <textarea name="content"
                            class="form-control p-3 border rounded-lg w-full text-gray-900 dark:bg-gray-700 dark:text-gray-300"
                            rows="3" placeholder="Escribe tu comentario aquí..." required></textarea>
                    </div>
                    <button type="submit"
                        class="rounded-md px-4 py-2 bg-gradient-to-r from-cyan-500 to-purple-500 text-white shadow-lg transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gradient-to-r hover:from-cyan-600 hover:to-purple-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-300 dark:bg-gradient-to-r dark:from-cyan-600 dark:to-purple-600 dark:text-white dark:hover:from-cyan-700 dark:hover:to-purple-700 dark:focus-visible:ring-cyan-400">Enviar
                        comentario</button>
                </form>
            </div>
            

            <!-- Mostrar Comentarios -->
            <div class="comments-list w-full bg-gray-900 dark:bg-gray-800 rounded-lg shadow-md">
                <div class="p-4">
                    <h5 class="text-xl font-bold text-white dark:text-white mb-4">Últimos comentarios</h5>
                    <ul role="list" class="divide-y text-white dark:divide-gray-700">
                        @foreach($capitulo->capituloComments as $comment)
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-10 h-10 text-gray-500 dark:text-gray-400">
                                        <path fill-rule="evenodd"
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7 9.75c0-.41.34-.75.75-.75h8.5c.41 0 .75.34.75.75s-.34.75-.75.75h-8.5c-.41 0-.75-.34-.75-.75zm0 4c0-.41.34-.75.75-.75h5.5c.41 0 .75.34.75.75s-.34.75-.75.75h-5.5c-.41 0-.75-.34-.75-.75zm4 4c0-.41.34-.75.75-.75h4.5c.41 0 .75.34.75.75s-.34.75-.75.75h-4.5c-.41 0-.75-.34-.75-.75z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-white truncate dark:text-white">
                                        {{ $comment->user->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $comment->content }}
                                    </p>
                                    <!-- Botón para eliminar comentario -->
                                    <form action="{{ route('capituloComments.destroy', $comment->id) }}" method="POST"
                                        class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>





    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const temporadaSelect = document.getElementById('temporada-select');
        const capitulosContainer = document.getElementById('capitulos-container');
        const temporadas = @json($temporadas);
        const imagenSerie =
            "{{ asset('images/' . $capitulo->temporada->serie->imagen) }}"; // Obtener la imagen de la serie desde el backend

        function cargarCapitulos(temporadaId) {
            const temporada = temporadas.find(t => t.id == temporadaId);
            capitulosContainer.innerHTML = '';

            if (temporada && temporada.capitulos) {
                temporada.capitulos.forEach(capitulo => {
                    const capituloDiv = document.createElement('div');
                    capituloDiv.classList.add('p-4', 'bg-gray-800', 'rounded-lg', 'shadow-md',
                        'text-white', 'flex', 'flex-col', 'items-start', 'gap-4');

                    capituloDiv.innerHTML = `
                    <div class="flex items-center gap-4 mb-2">
                        <img src="${imagenSerie}" alt="Imagen de la serie" class="w-24 h-24 object-cover rounded-lg">
                        <div>
                            <h3 class="text-xl font-bold mb-1">${capitulo.titulo}</h3>
                            <p class="text-sm mb-1">Capítulo ${capitulo.numero_capitulo}</p>
                            <a href="/capitulos/${capitulo.id}" class="text-blue-500 underline">Ver Capítulo</a>
                        </div>
                    </div>
                `;
                    capitulosContainer.appendChild(capituloDiv);
                });
            }
        }

        temporadaSelect.addEventListener('change', function() {
            cargarCapitulos(this.value);
        });

        // Cargar los capítulos de la primera temporada al cargar la página
        if (temporadas.length > 0) {
            cargarCapitulos(temporadas[0].id);
        }
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

</body>

</html>