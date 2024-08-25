<?php

namespace App\Http\Controllers;

use App\Models\CapituloComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CapituloCommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'capitulo_id' => 'required|exists:capitulos,id',
            'content' => 'required|string|max:1000',
        ]);

        CapituloComment::create([
            'user_id' => Auth::id(),
            'capitulo_id' => $request->capitulo_id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comentario agregado exitosamente.');
    }

    public function destroy(CapituloComment $capituloComment)
    {
        // Verifica si el usuario es el propietario del comentario o un administrador
        if (Auth::id() === $capituloComment->user_id || Auth::user()->is_admin) {
            $capituloComment->delete();
            return redirect()->back()->with('success', 'Comentario eliminado exitosamente.');
        }

        return redirect()->back()->with('error', 'No tienes permiso para eliminar este comentario.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = CapituloComment::findOrFail($id);
        $comment->content = $request->content;
        $comment->save();

        return redirect()->back()->with('success', 'Comentario actualizado exitosamente.');
    }
}
