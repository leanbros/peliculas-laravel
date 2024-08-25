<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use Illuminate\Http\Request;
use App\Models\Temporada;
use App\Models\Serie;

class CapituloController extends Controller
{
    public function index()
    {
        $capitulos = Capitulo::all();
        return view('capitulos.index', compact('capitulos'));
    }

    public function create()
    {
        return view('capitulos.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'temporada_id' => 'required|integer|exists:temporadas,id',
        'titulo' => 'required|string|max:500',
        'numero_capitulo' => 'required|integer',
        'url' => 'required|string|max:500',
    ]);

    $capitulo = Capitulo::create($validatedData);

    // Encuentra la serie a partir de la temporada
    $temporada = Temporada::find($request->temporada_id);
    $serie = $temporada->serie; // Asumiendo que tienes una relación 'serie' en el modelo Temporada

    return redirect()->route('series.edit', $serie->id)->with('success', 'Capítulo creado con éxito.');
}

public function show($id)
{
    
    $capitulo = Capitulo::with('temporada.serie')->findOrFail($id);
    $temporada = $capitulo->temporada;
    
    // Obtener todas las temporadas de la serie
    $temporadas = Temporada::where('serie_id', $temporada->serie_id)->with('capitulos')->get();

    // Obtener el capítulo anterior
    $capituloAnterior = Capitulo::where('temporada_id', $temporada->id)
                                ->where('numero_capitulo', '<', $capitulo->numero_capitulo)
                                ->orderBy('numero_capitulo', 'desc')
                                ->first();
    
    // Obtener el capítulo siguiente
    $capituloSiguiente = Capitulo::where('temporada_id', $temporada->id)
                                ->where('numero_capitulo', '>', $capitulo->numero_capitulo)
                                ->orderBy('numero_capitulo', 'asc')
                                ->first();
    
    return view('capitulos.show', compact('capitulo', 'capituloAnterior', 'capituloSiguiente', 'temporadas'));

    $capitulo = Capitulo::with('comments.user')->findOrFail($id);
    return view('capitulos.show', compact('capitulo'));
}


    public function update(Request $request, Capitulo $capitulo)
{
    $request->validate([
        'titulo' => 'required|string|max:500',
        'numero_capitulo' => 'required|string|max:500',
        'url' => 'required|url|max:500', // Validar que la URL es válida
    ]);

    // Actualizar solo los campos necesarios
    $capitulo->update([
        'titulo' => $request->input('titulo'),
        'numero_capitulo' => $request->input('numero_capitulo'),
        'url' => $request->input('url'),
    ]);

    return redirect()->route('series.edit', $capitulo->temporada->serie_id)
                     ->with('success', 'Capítulo actualizado con éxito.');
}



public function destroy(Capitulo $capitulo)
{
    $serie_id = $capitulo->temporada->serie_id;
    $capitulo->delete();

    return redirect()->route('series.edit', $serie_id)
                     ->with('success', 'Capítulo eliminado con éxito.');
}


    public function storeMultiple(Request $request)
    {
        // Validación de datos
        $validatedData = $request->validate([
            'temporada_id' => 'required|integer|exists:temporadas,id',
            'titulo.*' => 'required|string|max:255',
            'numero_capitulo.*' => 'required|integer',
            'url.*' => 'required|url',
        ]);
    
        // Guardar capítulos
        foreach ($request->titulo as $index => $titulo) {
            Capitulo::create([
                'temporada_id' => $request->temporada_id,
                'titulo' => $titulo,
                'numero_capitulo' => $request->numero_capitulo[$index],
                'url' => $request->url[$index],
            ]);
        }
    
        // Redirigir con mensaje de éxito
        $temporada = Temporada::find($request->temporada_id);
        $serie = $temporada->serie; // Asumiendo que tienes una relación 'serie' en Temporada
    
        return redirect()->route('series.edit', $serie->id)->with('success', 'Capítulos creados con éxito.');
    }

}