<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
        <div class="pt-16">

            <main class="mt-28 container mx-auto px-6">
                <h1 class="text-3xl font-bold mb-4 text-white">{{ $pelicula->title }}</h1>
                <h3 class="text-white">Calificacion: {{ number_format($pelicula->averageRating(), 2) }}</h3>
                <div class="flex items-center">
                    @for ($i = 1; $i <= 5; $i++) @if ($i <=floor($pelicula->averageRating()))
                        <!-- Estrella llena -->
                        <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.049 2.927C9.337 2.036 10.663 2.036 10.951 2.927L12.084 6.518L15.967 7.03C16.919 7.155 17.261 8.28 16.541 8.879L13.812 11.137L14.625 14.901C14.809 15.832 13.774 16.538 13.004 15.997L9.999 13.982L6.995 15.997C6.225 16.538 5.19 15.832 5.374 14.901L6.187 11.137L3.458 8.879C2.738 8.28 3.08 7.155 4.032 7.03L7.915 6.518L9.049 2.927Z" />
                        </svg>
                        @elseif ($i - 0.5 <= $pelicula->averageRating())
                            <!-- Media estrella -->
                            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="half">
                                        <stop offset="50%" stop-color="currentColor" />
                                        <stop offset="50%" stop-color="transparent" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#half)"
                                    d="M9.049 2.927C9.337 2.036 10.663 2.036 10.951 2.927L12.084 6.518L15.967 7.03C16.919 7.155 17.261 8.28 16.541 8.879L13.812 11.137L14.625 14.901C14.809 15.832 13.774 16.538 13.004 15.997L9.999 13.982L6.995 15.997C6.225 16.538 5.19 15.832 5.374 14.901L6.187 11.137L3.458 8.879C2.738 8.28 3.08 7.155 4.032 7.03L7.915 6.518L9.049 2.927Z" />
                            </svg>
                            @else
                            <!-- Estrella vacía -->
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927C11.337 2.036 12.663 2.036 12.951 2.927L14.084 6.518L17.967 7.03C18.919 7.155 19.261 8.28 18.541 8.879L15.812 11.137L16.625 14.901C16.809 15.832 15.774 16.538 15.004 15.997L11.999 13.982L8.995 15.997C8.225 16.538 7.19 15.832 7.374 14.901L8.187 11.137L5.458 8.879C4.738 8.28 5.08 7.155 6.032 7.03L9.915 6.518L11.049 2.927Z" />
                            </svg>
                            @endif
                            @endfor
                </div>
                <iframe src="{{ $pelicula->slug }}" sandbox="allow-same-origin allow-scripts" width="80%" height="600px"
                    scrolling="no" frameborder="0" allowfullscreen="true"></iframe>

                <div class="mt-6 p-4 bg-gray-800 dark:bg-gray-800 rounded-lg shadow-md mx-auto">
                    <!-- Calificación de Película -->
                    <div class="rating-section mb-6">
                        <h3 class="text-xl font-semibold mb-4 text-gray-200 dark:text-gray-200">Calificación de la
                            película
                        </h3>
                        <form action="{{ route('rate') }}" method="POST">
                            @csrf
                            <input type="hidden" name="peliculas_id" value="{{ $pelicula->id }}">

                            <div class="rating">
                                @for($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" />
                                <label for="star{{ $i }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 star-icon"
                                        viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg>
                                </label>
                                @endfor
                            </div>
                            <br>
                            <button type="submit"
                                class="rounded-md px-4 py-2 bg-gradient-to-r from-cyan-500 to-purple-500 text-white shadow-lg transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gradient-to-r hover:from-cyan-600 hover:to-purple-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-300 dark:bg-gradient-to-r dark:from-cyan-600 dark:to-purple-600 dark:text-white dark:hover:from-cyan-700 dark:hover:to-purple-700 dark:focus-visible:ring-cyan-400">Calificar</button>
                        </form>
                    </div>

                    <!-- Agregar Comentario -->
                    <div class="comment-section mb-4">
                        <h3 class="text-xl font-semibold mb-4 text-white dark:text-gray-200">Agregar comentario:</h3>
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="peliculas_id" value="{{ $pelicula->id }}">
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
                </div>

                <!-- Mostrar Comentarios -->
                <div class="comments-list w-full bg-gray-900 dark:bg-gray-800 rounded-lg shadow-md">
                    <div class="p-4">
                        <h5 class="text-xl font-bold text-white dark:text-white mb-4">Últimos comentarios</h5>
                        <ul role="list" class="divide-y text-white dark:divide-gray-700">
                            @foreach($pelicula->comments as $comment)
                            <li class="py-3 sm:py-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-10 h-10 text-gray-500 dark:text-gray-400">
                                            <path fill-rule="evenodd"
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7 9.75c0-.41.34-.75.75-.75h8.5c.41 0 .75.34.75.75s-.34.75-.75.75h-8.5c-.41 0-.75-.34-.75-.75zm0 4c0-.41.34-.75.75-.75h5.5c.41 0 .75.34.75.75s-.34.75-.75.75h-5.5c-.41 0-.75-.34-.75-.75zm4 4c0-.41.34-.75.75-.75h4.5c.41 0 .75.34.75.75s-.34.75-.75.75h-4.5c-.41 0-.75-.34-.75-.75z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-white truncate dark:text-white">
                                            {{ $comment->user->name }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{ $comment->content }}
                                        </p>
                                    </div>
                                </div>
                                @if(Auth::check() && Auth::id() === $comment->user_id)
                                <div class="mt-2 flex justify-end">
                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                                    </form>
                                </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

        </div>


        </main>
        <footer class="py-16 text-center text-sm text-white dark:text-white/70">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
    </div>

    <style>
    /* Contenedor de calificación y comentarios */

    .rating-comments-container {
        background-color: #1f2937;
        /* Fondo claro */
    }

    .rating-comments-container .rating {
        display: flex;
        gap: 0.25rem;
    }

    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: left;
    }

    .rating input {
        display: none;
    }

    .rating label {
        cursor: pointer;
        width: 24px;
        height: 24px;
    }

    .rating label svg {
        fill: lightgray;
        transition: fill 0.3s;
    }

    .rating input:checked~label svg,
    .rating label:hover~label svg,
    .rating label:hover svg {
        fill: gold;
    }

    /* Estilo de los botones */
    .btn-primary {
        background-color: #3b82f6;
        /* Color de fondo azul */
        color: white;
        /* Color del texto */
        padding: 0.5rem 1rem;
        /* Espaciado del botón */
        border-radius: 0.375rem;
        /* Bordes redondeados */
        transition: background-color 0.2s ease;
        /* Transición suave para el color de fondo */
    }

    .btn-primary:hover {
        background-color: #2563eb;
        /* Color de fondo al pasar el ratón */
    }

    /* Estilos para el formulario de comentario */
    .form-control {
        border: 1px solid #2d3748;
        /* Borde gris claro */
    }

    /* Estilos para el formulario de comentario en modo oscuro */
    .dark .form-control {
        background-color: #1f2937;
        /* Fondo oscuro */
        border-color: #4b5563;
        /* Borde gris oscuro */
    }

    /* Estilo para el área de comentarios */
    .comments-list .comment {
        background-color: #2d3748;
        /* Fondo blanco */
        border: 1px solid #e5e7eb;
        /* Borde gris claro */
        color: #374151;
        /* Texto gris oscuro */
    }

    .dark .comments-list .comment {
        background-color: #111827;
        /* Fondo oscuro */
        border-color: #4b5563;
        /* Borde gris oscuro */
        color: #d1d5db;
        /* Texto gris claro */
    }

    /* Estilos para el header fijo */
    header {
        background-color: #1f2937;
        /* Color de fondo */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Sombra sutil */
    }
    </style>
</body>

</html>