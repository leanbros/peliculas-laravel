<?php

namespace App\Http\Controllers;

use App\Models\Temporada;
use Illuminate\Http\Request;
use App\Models\Serie;

class TemporadaController extends Controller
{
    public function index()
    {
        $temporadas = Temporada::all();
        return view('temporadas.index', compact('temporadas'));
    }

    public function create()
    {
        return view('temporadas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_temporada' => 'required|string|max:500',
            'fecha_de_lanzamiento' => 'required|string|max:500',
            'serie_id' => 'required|integer|exists:series,id',
        ]);

        Temporada::create($validatedData);

        return redirect()->route('series.edit', $request->serie_id)->with('success', 'Temporada creada con éxito.');
    }

    public function show(Temporada $temporada)
    {
        return view('temporadas.show', compact('temporada'));
    }

    public function edit(Temporada $temporada)
    {
        return view('temporadas.edit', compact('temporada'));
    }

    public function update(Request $request, Temporada $temporada)
    {
        $request->validate([
            'nombre_temporada' => 'required|string|max:500',
            'fecha_de_lanzamiento' => 'required|string|max:500',
            'serie_id' => 'required|exists:series,id',
        ]);

        $temporada->update($request->all());

        return redirect()->route('series.edit', $temporada->serie_id)->with('success', 'Temporada actualizada con éxito.');
    }

    public function destroy(Temporada $temporada)
    {
        $temporada->delete();

        return redirect()->route('series.edit', $temporada->serie_id)->with('success', 'Temporada eliminada con éxito.');
    }
}


