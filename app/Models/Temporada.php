<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    use HasFactory;

    protected $fillable = ['serie_id', 'title', 'season_number'];

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'serie_id');
    }

    public function capitulos()
    {
        return $this->hasMany(Capitulo::class, 'temporada_id');
    }
}



