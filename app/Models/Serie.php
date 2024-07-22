<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'image', 'posted', 'category_id'];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'category_id');
    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class, 'serie_id');
    }

    public function capitulos()
    {
        return $this->hasMany(Capitulo::class, 'serie_id');
    }
}
