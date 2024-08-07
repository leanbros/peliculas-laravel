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

        <header class="fixed top-0 left-0 w-full z-50 flex items-center justify-between py-4 bg-gray-800 shadow-md">
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

        <div class="pt-36">
            <div class="container mx-auto py-8">
                <h1 class="text-4xl font-bold mb-4 text-white">
                    {{ $capitulo->temporada->serie->nombre_serie }} - {{ $capitulo->titulo }}
                </h1>

                <div class="relative overflow-hidden rounded-lg shadow-lg bg-gray-800">
                    <iframe src="{{ $capitulo->url }}" sandbox="allow-same-origin allow-scripts" width="100%"
                        height="600px" scrolling="no" frameborder="0" allowfullscreen="true"></iframe>
                </div>

                <div class="mt-4">
                    <p class="text-lg">{{ $capitulo->descripcion }}</p>
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
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const temporadaSelect = document.getElementById('temporada-select');
            const capitulosContainer = document.getElementById('capitulos-container');
            const temporadas = @json($temporadas);

            function cargarCapitulos(temporadaId) {
                const temporada = temporadas.find(t => t.id == temporadaId);
                capitulosContainer.innerHTML = '';

                if (temporada && temporada.capitulos) {
                    temporada.capitulos.forEach(capitulo => {
                        const capituloDiv = document.createElement('div');
                        capituloDiv.classList.add('p-4', 'bg-gray-800', 'rounded-lg', 'shadow-md',
                            'text-white');
                        capituloDiv.innerHTML = `
                        <h3 class="text-xl font-bold mb-2">${capitulo.titulo}</h3>
                        <p class="text-sm mb-2">Capítulo ${capitulo.numero_capitulo}</p>
                        <a href="/capitulos/${capitulo.id}" class="text-blue-500 underline">Ver Capítulo</a>
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