
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container mx-auto py-12">
    <h1 class="text-4xl font-bold mb-4">Resultados de la búsqueda</h1>

    <h2 class="text-2xl font-semibold mb-4">Películas</h2>
    @if($peliculas->isNotEmpty())
        <ul>
            @foreach($peliculas as $pelicula)
                <li>{{ $pelicula->titulo }}</li>
            @endforeach
        </ul>
    @else
        <p>No se encontraron películas.</p>
    @endif

    <h2 class="text-2xl font-semibold mt-8 mb-4">Series</h2>
    @if($series->isNotEmpty())
        <ul>
            @foreach($series as $serie)
                <li>{{ $serie->nombre_serie }}</li>
            @endforeach
        </ul>
    @else
        <p>No se encontraron series.</p>
    @endif
</div>
</body>
</html>