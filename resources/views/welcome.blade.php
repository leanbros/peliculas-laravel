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
                                src="{{ asset('images/profile_pictures/' . Auth::user()->profile_picture) }}"
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
                    class="rounded-md px-4 py-2 bg-gradient-to-r from-cyan-500 to-purple-500 text-white shadow-lg transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gradient-to-r hover:from-cyan-600 hover:to-purple-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-300 dark:bg-gradient-to-r dark:from-cyan-600 dark:to-purple-600 dark:text-white dark:hover:from-cyan-700 dark:hover:to-purple-700 dark:focus-visible:ring-cyan-400">
                    Ingresar
                </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="rounded-md px-4 py-2 bg-gradient-to-r from-cyan-500 to-purple-500 text-white shadow-lg transition duration-300 ease-in-out transform hover:scale-105 hover:bg-gradient-to-r hover:from-cyan-600 hover:to-purple-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-300 dark:bg-gradient-to-r dark:from-cyan-600 dark:to-purple-600 dark:text-white dark:hover:from-cyan-700 dark:hover:to-purple-700 dark:focus-visible:ring-cyan-400">
                    Registrarse
                </a>
                @endif
            </div>
            @endauth
            @endif
        </div>
        </div>
    </header>
    

    <main class="container mx-auto px-4 py-8 mt-16">
    @if(request()->filled('search'))
        <div class="mt-6">
            <h2 class="text-2xl font-bold mb-4 text-white">Resultados de la búsqueda</h2>

            <!-- Resultados combinados -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                <!-- Resultados de Películas -->
                @if($peliculas->isNotEmpty())
                    @foreach ($peliculas as $pelicula)
                        @if ($loop->index < 5)
                            <div class="w-48 flex-shrink-0 rounded-lg overflow-hidden shadow-lg bg-white dark:bg-gray-800">
                                <a href="{{ route('peliculas.show', $pelicula->id) }}" class="block">
                                    @if($pelicula->image)
                                        <img src="{{ asset('images/' . $pelicula->image) }}" alt="{{ $pelicula->title }}" class="w-full h-64 object-cover">
                                    @endif
                                    <div class="p-4">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $pelicula->title }}</h2>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif

                <!-- Resultados de Series -->
                @if($series->isNotEmpty())
                    @foreach ($series as $serie)
                        @if ($loop->index < 5)
                            <div class="w-48 flex-shrink-0 rounded-lg overflow-hidden shadow-lg bg-white dark:bg-gray-800">
                                <a href="{{ route('series.show', $serie->id) }}" class="block">
                                    @if($serie->image)
                                        <img src="{{ asset('images/' . $serie->imagen) }}" alt="{{ $serie->nombre_serie }}" class="w-full h-64 object-cover">
                                    @endif
                                    <div class="p-4">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $serie->nombre_serie }}</h2>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    @else
        
    @endif

    <!-- Categorías y sus películas/series -->
    <div class="container mx-auto py-8">
        @foreach ($categories as $category)
            @if ($category->peliculas->count() > 0 || $category->series->count() > 0)
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-white mb-4">{{ $category->titulo }}</h2>

                    <!-- Películas -->
                    @if ($category->peliculas->count() > 0)
                        <h3 class="text-xl font-semibold text-gray-300 mb-2">Películas</h3>
                        <div class="relative group carousel-container">
                            <!-- Botón anterior -->
                            <button class="absolute left-0 top-1/2 transform -translate-y-3/4 bg-gray-800 text-white p-2 rounded-full carousel-prev hidden">‹</button>
                            <div class="flex overflow-x-scroll space-x-8 p-4 scrollbar-hide carousel-container bg-gray-900 dark:bg-gray-700 rounded-lg">
                                @foreach ($category->peliculas as $pelicula)
                                    @if ($loop->index < 5)
                                        <div class="w-48 flex-shrink-0 rounded-lg overflow-hidden shadow-lg bg-white dark:bg-gray-800">
                                            <a href="{{ route('peliculas.show', $pelicula->id) }}" class="block">
                                                @if($pelicula->image)
                                                    <img src="{{ asset('images/' . $pelicula->image) }}" alt="{{ $pelicula->title }}" class="w-full h-64 object-cover">
                                                @endif
                                                <div class="p-4">
                                                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $pelicula->title }}</h2>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <!-- Botón siguiente -->
                            <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full carousel-next hidden">›</button>
                        </div>
                    @endif

                    <!-- Series -->
                    @if ($category->series->count() > 0)
                        <h3 class="text-xl font-semibold text-gray-300 mb-2 mt-4">Series</h3>
                        <div class="relative group carousel-container">
                            <!-- Botón anterior -->
                            <button class="absolute left-0 top-1/2 transform -translate-y-3/4 bg-gray-800 text-white p-2 rounded-full carousel-prev hidden">‹</button>
                            <div class="flex overflow-x-scroll space-x-8 p-4 scrollbar-hide carousel-container bg-gray-900 dark:bg-gray-700 rounded-lg">
                                @foreach ($category->series as $serie)
                                    @if ($loop->index < 5)
                                        <div class="w-48 flex-shrink-0 rounded-lg overflow-hidden shadow-lg bg-white dark:bg-gray-800">
                                            <a href="{{ route('series.show', $serie->id) }}" class="block">
                                                @if($serie->imagen)
                                                    <img src="{{ asset('images/' . $serie->imagen) }}" alt="{{ $serie->nombre_serie }}" class="w-full h-64 object-cover">
                                                @endif
                                                <div class="p-4">
                                                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $serie->nombre_serie }}</h2>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <!-- Botón siguiente -->
                            <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full carousel-next hidden">›</button>
                        </div>
                    @endif
                </div>
            @endif
        @endforeach
    </div>

</main>

<footer class="py-16 text-center text-sm bg-gray-800 text-white">
    Dondiman
</footer>


    <style>
    [data-carousel="slide"] {
        position: relative;
    }

    [data-carousel="slide"] .hidden {
        display: none;
    }

    [data-carousel="slide"] .duration-700 {
        transition: opacity 0.7s ease-in-out;
    }

    .carousel-container::-webkit-scrollbar {
        display: none;
    }

    .carousel-container {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const prevButtons = document.querySelectorAll('.carousel-prev');
        const nextButtons = document.querySelectorAll('.carousel-next');

        prevButtons.forEach(button => {
            button.addEventListener('click', function() {
                const container = button.nextElementSibling;
                container.scrollBy({
                    left: -container.offsetWidth,
                    behavior: 'smooth'
                });
            });
        });

        nextButtons.forEach(button => {
            button.addEventListener('click', function() {
                const container = button.previousElementSibling;
                container.scrollBy({
                    left: container.offsetWidth,
                    behavior: 'smooth'
                });
            });
        });

        // Mostrar botones de navegación si es necesario
        const containers = document.querySelectorAll('.carousel-container');
        containers.forEach(container => {
            if (container.scrollWidth > container.clientWidth) {
                container.parentElement.querySelector('.carousel-prev').classList.remove('hidden');
                container.parentElement.querySelector('.carousel-next').classList.remove('hidden');
            }
        });
    });

    // script de carrusel
    document.addEventListener('DOMContentLoaded', function() {
        const prevButton = document.querySelector('[data-carousel-prev]');
        const nextButton = document.querySelector('[data-carousel-next]');
        const slides = document.querySelectorAll('[data-carousel-item]');
        const indicators = document.querySelectorAll('[data-carousel-slide-to]');

        let currentSlideIndex = 0;

        function updateCarousel() {
            slides.forEach((slide, index) => {
                slide.classList.toggle('hidden', index !== currentSlideIndex);
            });
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('bg-white', index === currentSlideIndex);
                indicator.classList.toggle('bg-white/50', index !== currentSlideIndex);
            });
        }

        prevButton.addEventListener('click', () => {
            currentSlideIndex = (currentSlideIndex - 1 + slides.length) % slides.length;
            updateCarousel();
        });

        nextButton.addEventListener('click', () => {
            currentSlideIndex = (currentSlideIndex + 1) % slides.length;
            updateCarousel();
        });

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentSlideIndex = index;
                updateCarousel();
            });
        });

        updateCarousel();
    });
    </script>
</body>

</html>