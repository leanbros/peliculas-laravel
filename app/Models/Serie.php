<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_serie',
        'descripcion',
        'fecha_de_lanzamiento',
        'imagen',
        'posted',
        'category_id', // Asegúrate de que esto esté aquí
    ];

    public function temporadas()
    {
        return $this->hasMany(Temporada::class, 'serie_id');
    }

    public function category()
    {
        return $this->belongsTo(Categorias::class, 'category_id');
    }
}

