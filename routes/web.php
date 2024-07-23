<?php

use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CommentController;


// Ruta de bienvenida
Route::get('/', [PeliculasController::class, 'lista'])->name('welcome');

// Ruta del dashboard con autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('administrador')) {
            return app(PeliculasController::class)->index();
        } else {
            $userId = $user->id;
            return app(CommentController::class)->index($userId);
        }
    })->name('dashboard');

    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para calificaciones
    Route::post('/rate', [RatingController::class, 'store'])->name('rate');
    Route::get('/calificaciones', function () {
        $user = auth()->user();
        $userId = $user->id;
        return app(RatingController::class)->index($userId);
    })->name('calificaciones.index');
    Route::delete('/calificaciones/{rating}', [RatingController::class, 'destroy'])->name('calificaciones.destroy');
    Route::patch('/calificaciones/{id}', [RatingController::class, 'update'])->name('calificaciones.update');

    // Rutas para comentarios
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::patch('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
});

// Rutas de películas
Route::resource('posts', PeliculasController::class);
Route::get('/peliculas', [PeliculasController::class, 'lista'])->name('peliculas.lista');
Route::get('/peliculas/{id}', [PeliculasController::class, 'show'])->name('peliculas.show');

// Rutas para categorías
Route::resource('categories', CategoryController::class);







// Rutas para capítulos y temporadas
Route::resource('capitulos', CapitulosController::class)->except(['index', 'show']);
Route::resource('temporadas', TemporadasController::class)->except(['index', 'show']);

// Ruta de categorías con autenticación y verificación
Route::get('/Categorias', function () {
    return view('Categorias');
})->middleware(['auth', 'verified'])->name('Categorias');

require __DIR__.'/auth.php';
