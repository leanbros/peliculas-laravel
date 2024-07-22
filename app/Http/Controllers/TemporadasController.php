<?php

namespace App\Http\Controllers;

use App\Models\Temporada;
use App\Models\Serie;
use Illuminate\Http\Request;
use App\Models\Capitulo;

class TemporadasController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'season_number' => 'required|integer',
            'serie_id' => 'required|exists:series,id',
        ]);

        Temporada::create($validated);

        return back()->with('success', 'Temporada agregada exitosamente.');
    }

    public function edit($id)
    {
        $temporada = Temporada::findOrFail($id);
        return view('temporadas.edit', compact('temporada'));
    }

    public function update(Request $request, $id)
    {
        $temporada = Temporada::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'season_number' => 'required|integer',
        ]);

        $temporada->update($validated);

        return back()->with('success', 'Temporada actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $temporada = Temporada::findOrFail($id);
        $temporada->delete();

        return back()->with('success', 'Temporada eliminada exitosamente.');
    }
}
