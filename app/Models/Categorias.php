<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Categorias extends Model
{
    use HasFactory;
    use HasRoles;
    protected $fillable = ['titulo', 'descripcion'];
    // Especifica el nombre de la tabla
    protected $table = 'categorias';
    public function peliculas()
        {
            return $this->hasMany(Peliculas::class, 'category_id');
        }

        
        public function series()
    {
        return $this->hasMany(Serie::class, 'category_id');
    }
}
