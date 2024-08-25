<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapituloComment extends Model
{
    use HasFactory;

    // Permitir asignación masiva
    protected $fillable = ['user_id', 'capitulo_id', 'content'];

    // Relación con Capitulo
    public function capitulo()
    {
        return $this->belongsTo(Capitulo::class);
    }

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
