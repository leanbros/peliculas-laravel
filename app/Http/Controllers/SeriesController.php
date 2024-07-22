<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Serie;
use App\Models\Temporada;
use App\Models\Capitulo;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $series = Serie::paginate(10); // Ajusta el número de elementos por página según tus necesidades

        return view('series.index', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // Obtener las categorías para el select
       $categorias = Categorias::pluck('titulo', 'id'); // Asegúrate de que 'id' es la columna correcta
        
       // Pasar las categorías a la vista
       return view('series.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:series',
            'description' => 'nullable|string',
            'season' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categorias,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        }
    
        Serie::create($validated);
    
        return redirect()->route('series.index')->with('success', 'Serie agregada exitosamente.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Serie $serie)
{
    $categorias = Categorias::pluck('titulo', 'id');
    $temporadas = $serie->temporadas; // Obtener las temporadas de la serie
    return view('series.edit', compact('serie', 'categorias', 'temporadas'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Series $series)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image',
        'category_id' => 'required|exists:categorias,id',
        'capitulos.*.title' => 'required|string|max:255',
        'capitulos.*.episode_number' => 'required|integer',
        'capitulos.*.description' => 'nullable|string',
    ]);

    // Actualizar la serie sin la imagen
    $serie->update($validated);

    // Manejar la imagen si se proporciona
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $serie->update(['image' => basename($imagePath)]);
    }

    // Manejar los capítulos
    if ($request->has('capitulos')) {
        foreach ($request->capitulos as $capitulo) {
            $serie->capitulos()->updateOrCreate(
                ['id' => $capitulo['id'] ?? null],
                $capitulo
            );
        }
    }

    return redirect()->route('series.index')->with('success', 'Serie actualizada exitosamente.');
}





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Serie $serie)
{
    $serie->delete();
    return redirect()->route('series.index')->with('success', 'Serie eliminada exitosamente.');
}

}