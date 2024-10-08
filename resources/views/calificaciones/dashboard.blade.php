<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bienvenido') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!--contenido -->
                    <div>
                        <br>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <table class="w-full divide-y divide-gray-200 mt-4">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Peliculas</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Puntuacion</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Puntuacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($calificaciones as $nota)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $nota->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $nota->pelicula->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $nota->rating }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center align-middle">
                                        <div class="flex items-center">
                                            <a href="#" onclick="openModal('{{$nota->pelicula->title }}', '{{$nota->rating}}', '{{ $nota->id }}')" class="inline-block mr-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 text-yellow-500">
                                                    <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('calificaciones.destroy', $nota->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6">
                                                        <path fill="currentColor" d="M400 64h-88v-8c0-17.7-14.3-32-32-32h-96c-17.7 0-32 14.3-32 32v8H48c-13.3 0-24 10.7-24 24v32c0 13.3 10.7 24 24 24h24v336c0 26.5 21.5 48 48 48h208c26.5 0 48-21.5 48-48V144h24c13.3 0 24-10.7 24-24v-32c0-13.3-10.7-24-24-24zM176 56c0-4.4 3.6-8 8-8h80c4.4 0 8 3.6 8 8v8h-96v-8zm184 432c0 8.8-7.2 16-16 16H96c-8.8 0-16-7.2-16-16V144h280v344zm-40-224H128c-8.8 0-16-7.2-16-16s7.2-16 16-16h192c8.8 0 16 7.2 16 16s-7.2 16-16 16z"/>
                                                    </svg>
                                                
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     <!-- Modal -->
                    <div id="myModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-25 hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                            <h2 class="text-2xl font-bold mb-4 text-black" id="movieTitle"></h2>
                            <p class="mb-4 text-black">Calificación actual: <span id="movieRating"></span></p>

                            <!-- Formulario para cambiar la calificación -->
                            <form id="ratingForm" action="" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="rating">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" />
                                        <label for="star{{ $i }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 star-icon" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                        </label>
                                    @endfor
                                </div>
                                <br>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Guardar Cambios
                                </button>
                            </form>

                            <button onclick="closeModal()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4">
                                Cerrar
                            </button>
                        </div>
                    </div>
                    <br>
                        @if($calificaciones->count())
                            {{ $calificaciones->links('vendor.pagination.semantic-ui') }}
                        @else
                            <p>No hay posts disponibles.</p>
                        @endif
                </div>
                </div>   
            </div>
        </div>
    </div>
    <script>
        function openModal(title, rating, id) {
            document.getElementById('movieTitle').textContent = title;
            document.getElementById('movieRating').textContent = rating;
            document.getElementById('ratingForm').action = '{{ route("calificaciones.update", ":id") }}'.replace(':id', id);
            document.getElementById('myModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('myModal').classList.add('hidden');
        }  

    </script>
     <style>
        /* Contenedor de calificación y comentarios */
        .rating-comments-container {
            background-color: #f0f0f0;
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
        .rating input:checked ~ label svg,
        .rating label:hover ~ label svg,
        .rating label:hover svg {
            fill: gold;
        }
        </style>
</x-app-layout>