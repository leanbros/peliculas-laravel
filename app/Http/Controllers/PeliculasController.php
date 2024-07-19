<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peliculas;
use App\Models\Categorias;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;


class PeliculasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peliculas = Peliculas::with('category')->paginate(10);
        return view('dashboard', ['data' => $peliculas, 'type' => 'Peliculas']);
    }

    public function lista(Request $request)
    {
        $query = Peliculas::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhereHas('category', function($q) use ($search) {
                    $q->where('titulo', 'LIKE', "%{$search}%");
                });
        }

        $peliculas = $query->get();

        if ($request->filled('search')) {
            $categories = Categorias::whereHas('peliculas', function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('titulo', 'LIKE', "%{$search}%");
                  });
            })->with(['peliculas' => function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('titulo', 'LIKE', "%{$search}%");
                  });
            }])->get();
        } else {
            $categories = Categorias::with('peliculas')->get();
        }
    
        return view('welcome', compact('peliculas', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorias::pluck('id', 'titulo');
        //dd($categories);
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'required|integer',
        'description' => 'nullable|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'fondo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'posted' => 'required|string|in:not,yes',
    ]);

    // Procesar la imagen principal
    $image = $request->file('image');
    $imageName = time() . '.' . $image->extension();
    $image->move(public_path('images'), $imageName);

    // Procesar la imagen de fondo
    $fondoName = null;
    if ($request->hasFile('fondo')) {
        $fondo = $request->file('fondo');
        $fondoName = time() . '_fondo.' . $fondo->extension();
        $fondo->move(public_path('images'), $fondoName);
    }

    $data = $request->all();
    $data['image'] = $imageName;
    if ($fondoName) {
        $data['fondo'] = $fondoName;
    }

    Peliculas::create($data);

    return redirect()->route('posts.index')
                    ->with('success', 'Agregado correctamente.');
}



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pelicula = Peliculas::with('comments.user')->findOrFail($id);
        return view('peliculas.show', compact('pelicula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peliculas $post)
    {
        $categories = Categorias::pluck('titulo', 'id');
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'required|integer',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'fondo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'posted' => 'required|string|in:not,yes',
    ]);

    $post = Peliculas::findOrFail($id);

    // Procesar la imagen principal
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $post->image = $imageName;
    }

    // Procesar la imagen de fondo
    if ($request->hasFile('fondo')) {
        $fondo = $request->file('fondo');
        $fondoName = time() . '_fondo.' . $fondo->extension();
        $fondo->move(public_path('images'), $fondoName);
        $post->fondo = $fondoName;
    }

    $post->title = $request->title;
    $post->slug = $request->slug;
    $post->content = $request->content;
    $post->category_id = $request->category_id;
    $post->description = $request->description;
    $post->posted = $request->posted;

    $post->save();

    return redirect()->route('posts.index')
                    ->with('success', 'Actualizado correctamente.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelicula = Peliculas::find($id);

        if ($pelicula) {
            Log::info('Eliminando película con ID: ' . $id);
            $pelicula->delete();
            Log::info('Película eliminada con éxito: ' . $id);
            return redirect()->route('posts.index')->with('success', 'Registro eliminado.');
        } else {
            Log::error('Película no encontrada con ID: ' . $id);
            return redirect()->route('posts.index')->with('error', 'Registro no encontrado.');
        }
    }
}