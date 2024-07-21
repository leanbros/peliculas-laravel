<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Serie;

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
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categorias,id',
        ]);

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
    public function edit(string $id)
    {
        return view('series.edit', compact('series'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:series,slug,' . $series->id,
            'description' => 'nullable|string',
            'season' => 'nullable|integer',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $series->update($validated);

        return redirect()->route('series.index')->with('success', 'Serie actualizada exitosamente.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $series->delete();
        return redirect()->route('series.index')->with('success', 'Serie eliminada exitosamente.');
    }
}
