<?php

namespace App\Http\Controllers;

use App\Models\Peliculas;
use App\Models\Serie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $peliculas = Peliculas::where('titulo', 'like', "%$searchTerm%")->get();
        $series = Serie::where('nombre_serie', 'like', "%$searchTerm%")->get();

        return view('resultados-busqueda', compact('peliculas', 'series'));
    }
}
