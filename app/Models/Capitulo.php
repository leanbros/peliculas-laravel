<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'numero_capitulo', 'url', 'temporada_id'
    ];

    public function temporada()
    {
        return $this->belongsTo(Temporada::class, 'temporada_id');
    }
    public function capituloComments()
    {
        return $this->hasMany(CapituloComment::class);
    }
}

