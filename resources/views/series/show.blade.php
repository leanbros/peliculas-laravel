<x-app-layout>

    <!--Background-->
    
        <div class="flex justify-center">
            <div class="max-w-3x3">
                <div class="m-4 block rounded-lg bg-gray-800 p-6 shadow-lg dark:bg-neutral-800 dark:shadow-black/20">
                    <!-- Información de la serie -->
                    <div class="md:flex md:flex-row">
                        <div class="mx-auto mb-6 flex w-36 items-center justify-center md:mx-0 md:w-96 lg:mb-0">
                            @if ($serie->imagen)
                                <img src="{{ asset('images/' . $serie->imagen) }}" alt="{{ $serie->nombre_serie }}" class="h-auto max-w-sm rounded-lg shadow-none transition-shadow duration-300 ease-in-out hover:shadow-lg hover:shadow-black/30">
                            @endif
                            
                        </div>
                        <div class="md:ms-6">
                            <p class="mb-2 text-x1 font-semibold text-neutral-200">
                                {{ $serie->nombre_serie }}
                            </p>
                            <p class="mb-6 font-light text-neutral-200">
                                {{ $serie->descripcion }}
                            </p>
                        </div>
                        
                    </div>
                    @foreach ($serie->temporadas as $temporada)
                <div class="bg-gray-700 rounded-lg shadow-xl overflow-hidden mt-4">
                    <div class="p-4">
                        <h2 class="text-2xl font-bold text-white">{{ $temporada->nombre_temporada }}</h2>
                        <ul class="mt-4 space-y-4">
                            @foreach ($temporada->capitulos as $capitulo)
                                <li class="bg-gray-800 rounded-lg shadow p-4">
                                    <a href="{{ route('capitulos.show', $capitulo->id) }}" class="text-lg font-semibold text-gray-200 hover:text-white">
                                        {{ $capitulo->titulo }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
