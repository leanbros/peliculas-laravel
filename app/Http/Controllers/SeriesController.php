<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Categorias;
use Illuminate\Http\Request;
use App\Models\Temporada;
use App\Models\Peliculas;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::with('category')->paginate(10); // Cambia '10' al número de elementos que deseas por página
    return view('series.index', compact('series'));
    }
    
    public function lista(Request $request)
{
    $queryPeliculas = Peliculas::query();
    $querySeries = Serie::query(); // Asegúrate de tener el modelo correcto para Series

    if ($request->filled('search')) {
        $search = $request->input('search');

        // Buscar en películas
        $queryPeliculas->where('title', 'LIKE', "%{$search}%")
            ->orWhereHas('category', function($q) use ($search) {
                $q->where('titulo', 'LIKE', "%{$search}%");
            });

        // Buscar en series
        $querySeries->where('nombre_serie', 'LIKE', "%{$search}%")
            ->orWhereHas('category', function($q) use ($search) {
                $q->where('titulo', 'LIKE', "%{$search}%");
            });
    }

    $peliculas = $queryPeliculas->get();
    $series = $querySeries->get();

    $categories = Categorias::with(['peliculas', 'series'])->get(); // Incluye series aquí si es necesario

    return view('welcome', compact('peliculas', 'series', 'categories'));
}






    public function create()
    {
        $categories = Categorias::all(); // Obtener todas las categorías
        return view('series.create', compact('categories')); // Pasar las categorías a la vista
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre_serie' => 'required|string|max:500',
            'descripcion' => 'nullable|string',
            'fecha_de_lanzamiento' => 'required|date',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'posted' => 'required|in:yes,not',
            'category_id' => 'required|exists:categorias,id',
        ]);

        // Manejar la carga de la imagen si está presente
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $validated['imagen'] = $imageName;
        }

        // Crear la serie en la base de datos
        $serie = Serie::create($validated);

        // Redirigir a la vista de edición con mensaje de éxito
        return redirect()->route('series.edit', $serie->id)->with('success', 'Serie creada con éxito.');
    }

    public function show($id)
{
    $serie = Serie::with('temporadas.capitulos')->findOrFail($id);
    return view('series.show', compact('serie'));
}

    public function edit($id)
    {
        $serie = Serie::findOrFail($id);
    $categorias = Categorias::all(); // Asegúrate de tener el modelo y la consulta correctos
    
    return view('series.edit', compact('serie', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_serie' => 'required|string|max:500',
            'descripcion' => 'nullable|string',
            'fecha_de_lanzamiento' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'posted' => 'required|in:yes,not',
            'category_id' => 'required|exists:categorias,id',
        ]);

        $serie = Serie::findOrFail($id);

        // Actualizar los datos de la serie
        $serie->update($request->except('imagen'));

        // Manejar la carga de la imagen si está presente
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $serie->imagen = $imageName;
            $serie->save();
        }

        return redirect()->route('series.edit', $serie->id)->with('success', 'Serie actualizada con éxito.');
    }

    public function destroy(Serie $series)
    {
        $series->delete();

        return redirect()->route('series.index')->with('success', 'Serie eliminada con éxito.');
    }
}