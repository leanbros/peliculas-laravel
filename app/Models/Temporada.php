<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_temporada', 'fecha_de_lanzamiento', 'serie_id'
    ];

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'serie_id');
    }
    
    public function capitulos()
    {
        return $this->hasMany(Capitulo::class, 'temporada_id');
    }
}

