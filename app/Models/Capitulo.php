<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    use HasFactory;

    protected $fillable = ['temporada_id', 'title', 'episode_number', 'description'];

    public function temporada()
    {
        return $this->belongsTo(Temporada::class, 'temporada_id');
    }
}



