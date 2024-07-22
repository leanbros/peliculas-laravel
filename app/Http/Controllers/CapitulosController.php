<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use App\Models\Temporada;
use Illuminate\Http\Request;
use App\Models\Serie;


class CapitulosController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'episode_number' => 'required|integer',
            'url' => 'required|string|max:500',
            'description' => 'nullable|string',
            'temporada_id' => 'required|exists:temporadas,id',
        ]);

        Capitulo::create($validated);

        return back()->with('success', 'Capítulo agregado exitosamente.');
    }

    public function edit($id)
    {
        $capitulo = Capitulo::findOrFail($id);
        return view('capitulos.edit', compact('capitulo'));
    }

    public function update(Request $request, $id)
    {
        $capitulo = Capitulo::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'episode_number' => 'required|integer',
            'url' => 'required|string|max:500',
            'description' => 'nullable|string',
        ]);

        $capitulo->update($validated);

        return back()->with('success', 'Capítulo actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $capitulo = Capitulo::findOrFail($id);
        $capitulo->delete();

        return back()->with('success', 'Capítulo eliminado exitosamente.');
    }
}

